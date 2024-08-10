<?php

namespace Database\Seeders;

use App\Repositories\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRepository = new UserRepository();
        $users = [
            [
                'name' => 'iman',
                'email' => 'iman_sp@yahoo.com',
                'username' => 'iman330sp',
                'password'=> '12345678',
            ],
            [
                'name' => 'test',
                'email' => 'test@domain.tld',
                'username' => 'test',
                'password'=> '12345678',
            ]
        ];

        foreach ($users as $user) {
            $userRepository->create($user);
        }
    }
}
