<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Admin Nalog',
            'email' => 'admin@shop.com',
            'password' => Hash::make('sifra123')
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Petar Petrović',
            'email' => 'pera@shop.com',
            'password' => Hash::make('sifra123')
        ]);
    }
}