<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::findOrCreate('admin');
        Role::findOrCreate('user');

        User::factory()->create([
            'first_name' => 'MA',
            'last_name' => 'Textil',
            'email' => 'matextil@gmail.com',
            'password' => Hash::make('matextil@54321'),
        ])->assignRole('admin');
    }
}