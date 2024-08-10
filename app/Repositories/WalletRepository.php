<?php

namespace App\Repositories;

use App\Interfaces\WalletRepositoryInterface;
use App\Models\User;

class WalletRepository implements WalletRepositoryInterface
{

    public function show(User $user)
    {
        return $user->wallet;
    }

    public function deposit(User $user, int $amount)
    {
        $user->wallet->credit += $amount;
        $user->wallet->save();
    }

    public function Withdraw(User $user, int $amount)
    {
        if ($this->checkCredit($user, $amount)) {
            $user->wallet->credit -= $amount;
            $user->wallet->save();
        }
        return false;
    }

    public function checkCredit(User $user, int $amount): bool
    {
        return $user->wallet->credit >= $amount;
    }

}