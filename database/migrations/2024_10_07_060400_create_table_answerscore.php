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
        Schema::create('answerscore', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_quiz")->constrained("quizzes")->onDelete("cascade");
            $table->foreignId("id_user")->constrained("Users")->onDelete("cascade");
            $table->integer("score");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_answerscore');
    }
};
