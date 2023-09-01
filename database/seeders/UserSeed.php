<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "id" => 1,
            "name" => "Jesus Balderas", 
            "email" => "jbalderas109@gmail.com",
            "email_verified_at" => NULL,
            "password" =>'$2y$10$B30HbXRZHTHNeZ4YevNj/e0SlEebE6S0MftsGfD3DjC4ySXFWfbVe',
            "two_factor_secret" => NULL,
            "two_factor_recovery_codes" => NULL,
            "remember_token" => NULL,
            "current_team_id" => NULL,
            "profile_photo_path" => NULL,
            "created_at" => "2023-08-31 23:06:51",
            "updated_at" => "2023-08-31 23:06:51",
        ]);

    }
}
