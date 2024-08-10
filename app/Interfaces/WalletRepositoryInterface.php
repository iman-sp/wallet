<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function show(User $user);

    public function deposit(User $user, int $amount);

    public function Withdraw(User $user, int $amount);

    public function checkCredit(User $user, int $amount): bool;
}