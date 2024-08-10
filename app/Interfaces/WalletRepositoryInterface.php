<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function show(User $user);
}