<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name'=> 'Admin Bahadur',
            'email'=> 'admin@example.com',
            'password'=>Hash::make('admin123'),
            'created_by' => 1
        ]);
        User::create([
            'name' => 'Ram Bahadur',
            'email' => 'ram@example.com',
            'password' => Hash::make('ram123'),
            'created_by' => 1
        ]);
    }
}
