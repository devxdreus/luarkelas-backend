<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id("teacher_id");
            $table->unsignedBigInteger("user_id");
            $table->string('name');
            $table->string('jobdesc');
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->integer("age")->nullable();
            $table->string("religion")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("user_id")->references("user_id")->on("users");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};