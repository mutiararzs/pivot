<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('value'); // skala 1-5
            $table->timestamps();

            $table->unique(['assessment_id', 'question_id']); // 1 jawaban per soal
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};