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
        Schema::create('Score', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_assignment');
            $table->string('url')->nullable();
            $table->string('file')->nullable();
            $table->string('nama');
            $table->enum('status', ['belum_selesai', 'terlambat', 'selesai']);
            $table->string('nilai')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('Users');
            $table->foreign('id_assignment')->references('id')->on('Assignment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Score');
    }
};
