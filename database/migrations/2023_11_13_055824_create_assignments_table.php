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
        Schema::create('Assignment', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('catatan');
            $table->dateTime('deadline');
            $table->enum('metode_pengumpulan', ['url', 'file', 'semua']);
            $table->unsignedBigInteger('id_course');
            $table->timestamps();

            $table->foreign('id_course')->references('id')->on('Course');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Assignment');
    }
};
