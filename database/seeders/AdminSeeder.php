<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada, jika belum baru dibuat
        // Ini mencegah error duplicate entry saat seeder dijalankan berulang kali
        
        if (!User::where('email', 'admin123@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin Rastek',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            
            $this->command->info('✓ Admin Rastek created successfully');
        } else {
            $this->command->warn('✗ Admin Rastek already exists, skipped');
        }

        if (!User::where('email', 'rrendi6923@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin rendi',
                'email' => 'rrendi6923@gmail.com',
                'password' => Hash::make('rendiadmin'),
                'role' => 'admin',
            ]);
            
            $this->command->info('✓ Admin Aja created successfully');
        } else {
            $this->command->warn('✗ Admin Aja already exists, skipped');
        }
    }
}