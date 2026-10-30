<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status', 20)->default('in_progress'); // in_progress | completed
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            // Skor per dimensi Holland (diisi saat tes selesai)
            $table->unsignedSmallInteger('score_r')->nullable();
            $table->unsignedSmallInteger('score_i')->nullable();
            $table->unsignedSmallInteger('score_a')->nullable();
            $table->unsignedSmallInteger('score_s')->nullable();
            $table->unsignedSmallInteger('score_e')->nullable();
            $table->unsignedSmallInteger('score_c')->nullable();
            $table->string('holland_code', 3)->nullable();         // contoh: IRA

            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};