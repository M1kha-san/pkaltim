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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Langsung hubungkan ke rumah_makans
            $table->foreignId('rumah_makan_id')->constrained('rumah_makans')->onDelete('cascade');

            $table->string('nama_user');
            $table->tinyInteger('rating'); // Angka 1-5
            $table->text('komentar');
            $table->date('tanggal_review')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
