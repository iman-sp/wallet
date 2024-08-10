<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';

    public function label(): string
    {
        return match ($this)
        {
            self::DEPOSIT => 'واریز',
            self::WITHDRAW => 'برداشت',
        };
    }
}