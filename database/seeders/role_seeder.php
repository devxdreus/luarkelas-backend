<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class role_seeder extends Seeder
{
    public function run(): void
    {
        // role seeder
        Role::insert([
            [
                "description" => "admin",
            ],
            [
                "description" => "Student",
            ],
            [
                "description" => "Teacher",
            ],
            [
                "description" => "Guest",
            ],
        ]);
    }
}
