<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Jika sudah ada admin, lewati
        if (User::where('email', 'admin@example.com')->exists()) {
            return;
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password', // akan di-hash oleh model
            'role' => 'admin',
        ]);
    }
}
