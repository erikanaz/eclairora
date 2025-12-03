<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@eclairora.com',
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole('admin'); // <-- Peran dari Spatie

        // CUSTOMER
        $customer = User::create([
            'name' => 'Erika',
            'email' => 'erika@gmail.com',
            'password' => Hash::make('erika123'),
        ]);
        $customer->assignRole('customer'); // <-- Peran dari Spatie
    }
}
