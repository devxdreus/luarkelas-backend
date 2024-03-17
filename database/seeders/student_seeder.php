<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class student_seeder extends Seeder
{
    public function run(): void
    {
        // loop through 10 students
        for ($i = 0; $i < 20; $i++) {
            // create a student
            Student::create([
                "user_id" => $i + 8,
                "teacher_id" => rand(1, 6),
                "name" => fake()->name(),
                'parentname' => fake()->name(),
                'nickname' => fake()->name(),
                'birthdate' => fake()->date(),
                'birthplace' => fake()->city(),
                'schoolname' => fake()->company(),
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
                'grade' => rand(1, 12),
                'age' => rand(6, 18),
                'religion' => fake()->randomElement(["Islam", "Kristen", "Katolik", "Hindu", "Budha"]),
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }
    }
}