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

}