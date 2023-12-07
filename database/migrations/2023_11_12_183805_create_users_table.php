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
        Schema::create('Users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('fullname');
            $table->enum('role', ['user', 'admin']);
            $table->string('password');
            $table->unsignedBigInteger('id_tingkatan')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_tingkatan')->references('id')->on('Tingkatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Users');
    }
};
