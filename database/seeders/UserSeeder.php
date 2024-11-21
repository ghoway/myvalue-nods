<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('Administrator');

        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $operator->assignRole('Operator');
    }
}
