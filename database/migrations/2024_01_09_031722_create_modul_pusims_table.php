<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modul_pusims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pusim');
            $table->unsignedBigInteger('id_soal');
            $table->unsignedBigInteger('id_jawaban')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_pusim')
                ->references('id')
                ->on('pusims')
                ->onDelete('cascade');
            
            $table->foreign('id_soal')
            ->references('id')
            ->on('soals')
            ->onDelete('cascade');

            $table->foreign('id_jawaban')
                ->references('id')
                ->on('jawabans')
                ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_pengerjaan_ujian_simpers');
    }
};
