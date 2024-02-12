<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
           'first_name' => 'admin',
           'last_name' => 'Admin',
           'email' => 'ad@min.com',
           'phone' => '+9998998999',
           'password' => Hash::make('password'),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'first_name' => 'Umar',
            'last_name' => 'Nabijonov',
            'email' => 'umar04@gmail.com',
            'phone' => '+999899879349',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('editor');

        $user = User::create([
            'first_name' => 'Nodira',
            'last_name' => 'Nabijonova',
            'email' => 'nodira1@gmail.com',
            'phone' => '+998978793149',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('shop-manager');

        $user = User::create([
            'first_name' => 'Xamida',
            'last_name' => 'Rustamova',
            'email' => 'xamida09@gmail.com',
            'phone' => '+998978793199',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('helpdesk-support');

        $user = User::create([
            'first_name' => 'Ibrohim',
            'last_name' => 'Nabijonov',
            'email' => 'nibrohim@gmail.com',
            'phone' => '+9998998799',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('customer');

        $users = User::factory()->count(10)->create();
        foreach ($users as $user) {
            $user->assignRole('customer');
        }
    }
}
