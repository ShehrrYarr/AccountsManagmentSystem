<?php

namespace App\Support;

/**
 * Exact 2-decimal arithmetic for PKR amounts using bcmath strings.
 * Never use floats for ledger math.
 */
final class Money
{
    public const SCALE = 2;

    /** Normalise any numeric input to a "1234.56" string (rounded half-up). */
    public static function of(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '0.00';
        }

        $value = str_replace([',', ' '], '', (string) $value);

        if (! is_numeric($value)) {
            throw new \InvalidArgumentException("Invalid money value [{$value}].");
        }

        return self::round($value);
    }

    public static function add(mixed ...$values): string
    {
        $sum = '0.00';
        foreach ($values as $v) {
            $sum = bcadd($sum, self::of($v), self::SCALE);
        }

        return $sum;
    }

    public static function sub(mixed $a, mixed $b): string
    {
        return bcsub(self::of($a), self::of($b), self::SCALE);
    }

    /** Percentage of an amount, rounded half-up to paisa. */
    public static function percent(mixed $amount, mixed $rate): string
    {
        $raw = bcdiv(bcmul(self::of($amount), (string) $rate, 8), '100', 8);

        return self::round($raw);
    }

    public static function cmp(mixed $a, mixed $b): int
    {
        return bccomp(self::of($a), self::of($b), self::SCALE);
    }

    public static function isZero(mixed $a): bool
    {
        return self::cmp($a, 0) === 0;
    }

    public static function isNegative(mixed $a): bool
    {
        return self::cmp($a, 0) < 0;
    }

    public static function isPositive(mixed $a): bool
    {
        return self::cmp($a, 0) > 0;
    }

    public static function format(mixed $value, bool $symbol = true): string
    {
        $v = self::of($value);
        $formatted = number_format((float) $v, 2);

        return $symbol ? 'Rs. '.$formatted : $formatted;
    }

    private static function round(string $value): string
    {
        $half = str_starts_with($value, '-') ? '-0.005' : '0.005';

        return bcadd(bcadd($value, $half, 8), '0', self::SCALE);
    }
}
