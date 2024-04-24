<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id("student_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("teacher_id")->nullable();
            $table->string('name');
            $table->string("parentname")->nullable();
            $table->string("nickname")->nullable();
            $table->date("birthdate")->nullable();
            $table->string("birthplace")->nullable();
            $table->string("schoolname")->nullable();
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("grade")->nullable();
            $table->integer("age")->nullable();
            $table->string("religion")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("user_id")->references("user_id")->on("users");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};