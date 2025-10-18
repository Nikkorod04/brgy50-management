<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BarangayOfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the default Barangay Official account
        User::firstOrCreate(
            ['username' => 'brgy50'],
            [
                'name' => 'Barangay 50 Official',
                'email' => 'brgy50@barangay50.local',
                'password' => Hash::make('brgy50'),
                'role' => 'barangay_official',
                'email_verified_at' => now(),
            ]
        );
    }
}

