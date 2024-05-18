<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanSimper extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'pengajuan_simpers';
    protected $fillable = [
        'diterima_tgl',
        'id_user',
        'id_pembayaran',
        'id_jenis_pengajuan',
        'id_ujian',
        'nama',
        'dari',
        'perihal',
        'no_surat',
        'no_agenda',
        'no_badge',
        'jenis_simper',
        'surat_permohonan',
        'simpol',
        'badge',
        'spk',
        'simper_lama',
        'keterangan',
        'status_avp',
        'status_vp',
        'keterangan_revisi',
        
    ];
}