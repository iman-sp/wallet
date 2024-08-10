<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all(User $user)
    {
        return $user->transactions()->orderBy('id', 'desc')->get();
    }

    public function create(User $user, array $data)
    {
        $transaction = Transaction::create([
            ...$data,
            'user_id' => $user->id, // Prevent mass assignment vulnerability
        ]);
        return $transaction;
    }

}