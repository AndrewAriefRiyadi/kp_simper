<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Jawaban;

class Soal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'soals';
    protected $fillable = [
        'teks',
        'id_ujian',
    ];

    public function jawabans()
    {
        return $this->hasMany(Jawaban::class, 'id_soal');
    }
}
