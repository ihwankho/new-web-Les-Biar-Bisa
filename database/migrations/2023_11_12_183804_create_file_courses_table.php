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
        Schema::create('File_course', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('file');
            $table->unsignedBigInteger('id_course');
            $table->string('link', 255);
            $table->timestamps();

            $table->foreign('id_course')->references('id')->on('Course');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('File_course');
    }
};
