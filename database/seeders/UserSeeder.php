<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user sudah ada
        if (User::where('email', 'admin@karastock.com')->exists()) {
            $this->command->info('User admin sudah ada, tidak perlu dibuat lagi.');
            return;
        }

        // Buat user default
        User::create([
            'name' => 'Admin KaraStock',
            'email' => 'admin@karastock.com',
            'password' => Hash::make('admin123'),
        ]);

        $this->command->info('User admin berhasil dibuat!');
        $this->command->info('Email: admin@karastock.com');
        $this->command->info('Password: admin123');
    }
}

