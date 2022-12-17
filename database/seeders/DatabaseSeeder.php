<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\PermissionAdminRolesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([PermissionAdminRolesSeeder::class, PostSeeder::class]);
    }
}