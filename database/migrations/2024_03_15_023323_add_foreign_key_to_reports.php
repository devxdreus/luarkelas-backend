<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->foreign("student_id")->references("student_id")->on("students");
            $table->foreign("teacher_id")->references("teacher_id")->on("teachers");
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(["student_id"]);
            $table->dropForeign(["teacher_id"]);
        });
    }
};
