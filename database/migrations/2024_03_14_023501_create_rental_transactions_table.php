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
        Schema::create('rental_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_id');
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->foreign('mobil_id')->on('cars')->references('id');
            $table->foreign('user_id')->on('user_profiles')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_transactions');
    }
};
