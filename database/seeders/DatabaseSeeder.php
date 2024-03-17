<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            user_seeder::class,
            teacher_seeder::class,
            student_seeder::class,
            report_seeder::class,
        ]);
    }
}