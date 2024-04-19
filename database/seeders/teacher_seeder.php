<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class teacher_seeder extends Seeder
{
    public function run(): void
    {
        Teacher::insert([
            [
                "user_id" => 2,
                "name" => "Hidayatul Fitriya",
                "jobdesc" => "Guru Privat Preschool & Fisika/Science SD-SMP-SMA",
                "address" => fake()->address(),
                "phone" => fake()->phoneNumber(),
                'age' => rand(18, 33),
                "religion" => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "user_id" => 3,
                "name" => "Ghina Yumna Zakiyah",
                "jobdesc" => "Guru Privat Matematika SD-SMP-SMA",
                "address" => fake()->address(),
                "phone" => fake()->phoneNumber(),
                'age' => rand(18, 33),
                "religion" => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "user_id" => 4,
                "name" => "Rizal Hidayatulloh",
                "jobdesc" => "Guru Privat Matematika SMP-SMA",
                "address" => fake()->address(),
                "phone" => fake()->phoneNumber(),
                'age' => rand(18, 33),
                "religion" => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "user_id" => 5,
                "name" => "Lailatul Hidayah",
                "jobdesc" => "Guru Privat Bahasa Inggris SD-SMP",
                "address" => fake()->address(),
                "phone" => fake()->phoneNumber(),
                'age' => rand(18, 33),
                "religion" => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "user_id" => 6,
                "name" => "Muhammad Jefri Fransiska",
                "jobdesc" => "Guru Privat Matematika SMP-SMA",
                "address" => fake()->address(),
                "phone" => fake()->phoneNumber(),
                'age' => rand(18, 33),
                "religion" => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "user_id" => 7,
                "name" => "Faustine Amelia Handoko",
                "jobdesc" => "Guru Privat Science/Biologi SD-SMP-SMA",
                "address" => fake()->address(),
                "phone" => fake()->phoneNumber(),
                'age' => rand(18, 33),
                "religion" => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "user_id" => 8,
                "name" => "michaelchristiantjahyadi@gmail.com",
                "jobdesc" => "Guru Privat",
                "address" => fake()->address(),
                "phone" => fake()->phoneNumber(),
                'age' => rand(18, 33),
                "religion" => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}