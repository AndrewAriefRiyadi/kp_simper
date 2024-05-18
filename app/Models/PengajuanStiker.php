<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanStiker extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'pengajuan_stikers';
    protected $fillable = [
        'id_user',
        'id_pembayaran',
        'id_jenis_pengajuan',
        'id_ujian',
        'nama',
        'diterima_tgl',
        'dari',
        'perihal',
        'no_surat',
        'no_agenda',
        'no_badge',
        'id_durasi',
        'surat_permohonan',
        'spk',
        'stnk',
        'simpol',
        'badge',
        'buku',
        'pajak',
        'keterangan',
        'status_avp',
        'status_vp',
        'keterangan_revisi',
    ];
}
