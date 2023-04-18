<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $user = User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'two_factor_secret' => null,
        //     'two_factor_recovery_codes' => null,
        //     'remember_token' => Str::random(10),
        //     'profile_photo_path' => null,
        //     'current_team_id' => null,
        // ]);
        // $user->assignRole('Admin');

        // Create User Profile
        $profile = Profile::create([
            'user_id' => 1,//$user->id,
            'image' => 'default.png',
            'mobile' => '03078965876',
            'line1' => '598 Virginia Street, Apartment 2',
            'line2' => 'River Grove IL 60171',
            'city' => 'Boston',
            'province' => 'California',
            'country' => 'US',
            'zipcode' => '7788',
        ]);

    }
}
