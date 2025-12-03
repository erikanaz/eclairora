<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@eclairora.com',
                'password' => 'admin123',
                'role' => 'admin'
            ],
            [
                'name' => 'Erika',
                'email' => 'erika@gmail.com',
                'password' => 'erika123',
                'role' => 'customer'
            ],
        ]);
    }
}
