<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            ['id' => 1, 'title' => 'Dashboard', 'url' => '/dashboard', 'icon' => 'fas fa-tachometer-alt', 'parent_id' => null, 'role' => null, 'header' => 'DASHBOARD'],
            ['id' => 2, 'title' => 'Administrator', 'url' => '#', 'icon' => 'fas fa-user-shield', 'parent_id' => null, 'role' => 'Administrator', 'header' => 'ADMINISTRATOR'],
            ['id' => 3, 'title' => 'Manajemen Pengguna', 'url' => '/admin/manajemen-pengguna', 'icon' => 'far fa-circle text-warning', 'parent_id' => 2, 'role' => 'Administrator', 'header' => null],
            ['id' => 4, 'title' => 'Manajemen Menu', 'url' => '/admin/manajemen-menu', 'icon' => 'far fa-circle text-warning', 'parent_id' => 2, 'role' => 'Administrator', 'header' => null],
            ['id' => 5, 'title' => 'Manajemen Role', 'url' => '/admin/manajemen-role', 'icon' => 'far fa-circle text-warning', 'parent_id' => 2, 'role' => 'Administrator', 'header' => null],
            ['id' => 6, 'title' => 'Manajemen Permission', 'url' => '/admin/manajemen-permission', 'icon' => 'far fa-circle text-warning', 'parent_id' => 2, 'role' => 'Administrator', 'header' => null],
        ]);
    }
}
