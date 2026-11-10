<?php

namespace App\Enums;

/**
 * Government cheques don't bounce, so a cheque is either still in hand or deposited.
 */
enum ChequeStatus: string
{
    use HasOptions;

    case InHand = 'in_hand';
    case Deposited = 'deposited';

    public function label(): string
    {
        return match ($this) {
            self::InHand => 'In hand',
            self::Deposited => 'Deposited',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::InHand => 'bg-warning-subtle text-warning',
            self::Deposited => 'bg-success-subtle text-success',
        };
    }
}
