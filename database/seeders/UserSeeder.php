<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'gudang',
                'email' => 'gudang@mail.com',
                'password' => Hash::make('password'),
                'role' => 'gudang',
            ],
            [
                'name' => 'ceo',
                'email' => 'ceo@mail.com',
                'password' => Hash::make('password'),
                'role' => 'ceo',
            ],
            [
                'name' => 'rnd',
                'email' => 'rnd@mail.com',
                'password' => Hash::make('password'),
                'role' => 'rnd',
            ],
        ];

        User::insert($users);
    }
}
