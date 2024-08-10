<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{

    public function all()
    {

    }

    public function create(array $data)
    {
        $user = User::create([
            ...$data,
            'password' => bcrypt($data['password']),
        ]);
        return $user;
    }

    public function attempt(string $email, string $password, Request $request): bool
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return true;
        }
        return false;
    }

    public function update(array $data, $id)
    {

    }

    public function delete($id)
    {

    }

    public function find($id)
    {
        
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

}