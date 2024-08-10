<?php

namespace App\Interfaces;

use App\Models\User;

interface TransactionRepositoryInterface
{
    public function all(User $user);

    public function create(User $user, array $data);

}