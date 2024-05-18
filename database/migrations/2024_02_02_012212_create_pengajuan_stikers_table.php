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
        Schema::create('pengajuan_stikers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_ujian')->nullable();
            $table->unsignedBigInteger('id_pembayaran')->nullable();
            $table->string('nama');
            $table->date('diterima_tgl');
            $table->string('dari');
            $table->string('perihal');
            $table->integer('no_surat');
            $table->integer('no_agenda');
            $table->integer('no_badge');
            $table->unsignedBigInteger('id_durasi');
            $table->string('surat_permohonan');
            $table->string('spk');
            $table->string('stnk');
            $table->string('simpol');
            $table->string('badge');
            $table->string('buku');
            $table->string('pajak');
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('status_avp')->default(4);
            $table->unsignedBigInteger('status_vp')->default(4);
            $table->string('keterangan_revisi')->nullable();
            
            $table->foreign('id_pembayaran')->references('id')->on('pembayarans')->onDelete('cascade');
            $table->foreign('id_ujian')->references('id')->on('ujians')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_avp')->references('id')->on('vl_status')->onDelete('cascade');
            $table->foreign('status_vp')->references('id')->on('vl_status')->onDelete('cascade');
            $table->foreign('id_durasi')->references('id')->on('vl_durasis')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_stikers');
    }
};
