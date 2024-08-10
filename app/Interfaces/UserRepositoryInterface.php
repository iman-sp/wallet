<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function attempt(string $email, string $password, Request $request): bool;

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function findByEmail(string $email);
}