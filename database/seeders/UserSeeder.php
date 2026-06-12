<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@survei.com',
            'role' => 'admin',
            'password' => Hash::make('123'),
        ]);
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@survei.com',
            'role' => 'user',
            'password' => Hash::make('321'),
        ]);
    }
}