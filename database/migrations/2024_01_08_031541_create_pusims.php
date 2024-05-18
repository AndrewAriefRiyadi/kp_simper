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
        Schema::create('pusims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengajuan_simper');
            $table->integer('nilai')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_pengajuan_simper')->references('id')->on('pengajuan_simpers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengerjaan_ujian_simpers');
    }
};
