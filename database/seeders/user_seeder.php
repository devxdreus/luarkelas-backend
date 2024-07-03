<?php

namespace Database\Seeders;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                "role_id" => 1,
                "google_id" => null,
                "email" => "admin@admin",
                "password" => Hash::make("admin"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 3,
                "google_id" => null,
                "email" => "hidayatulfitriya9@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 3,
                "google_id" => null,
                "email" => "yumnayummy15@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 3,
                "google_id" => null,
                "email" => "rizal.hdyt087@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 3,
                "google_id" => null,
                "email" => "lailatulhidayah@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 3,
                "google_id" => null,
                "email" => "muhammadjefri@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 3,
                "google_id" => null,
                "email" => "faustineamelia@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 3,
                "google_id" => null,
                "email" => "michaelchristiantjahyadi@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "vanessaguan09@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "cornelliakwanda@gamil.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "calev.tanuwijoyo@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "eve121191@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "tan_indah@yahoo.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],

            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "Sofiamuljono@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "polin_friend@yahoo.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "Scarleticity@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "ayu_rahadjeng@yahoo.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "lstefbs@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "arietart86@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "Setiono.devina@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "role_id" => 2,
                "google_id" => null,
                "email" => "Dwipuspita945.dps@gmail.com",
                "password" => Hash::make("12345"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);

        Referral::factory(5)->create([
            'referrer_id' => 1,
        ]);
    }
}
