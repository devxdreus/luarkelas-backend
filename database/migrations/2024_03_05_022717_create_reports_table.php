<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id("report_id");
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("teacher_id");
            $table->string("title");
            $table->text("content");
            $table->integer("duration");
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
