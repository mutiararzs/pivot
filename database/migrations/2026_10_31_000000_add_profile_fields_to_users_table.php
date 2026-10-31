<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('tanggal_lahir');
            $table->string('school', 150)->nullable()->after('phone');
            $table->string('level', 10)->nullable()->after('school');   // SMA | SMK | MA
            $table->string('kelas', 20)->nullable()->after('level');    // contoh: 12 IPA
            $table->string('city', 100)->nullable()->after('kelas');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'school', 'level', 'kelas', 'city']);
        });
    }
};