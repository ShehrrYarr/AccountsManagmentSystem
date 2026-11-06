<?php

use App\Support\Money;

if (! function_exists('money')) {
    /** Format an amount as "Rs. 1,234.56". */
    function money(mixed $value, bool $symbol = true): string
    {
        return Money::format($value, $symbol);
    }
}
