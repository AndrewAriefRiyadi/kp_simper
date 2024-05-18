<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Jawaban;
use App\Models\PengajuanSimper;
use App\Models\PengajuanStiker;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\VL_Durasi;
use App\Models\VL_JenisPengajuan;
use App\Models\VL_JenisUjian;
use App\Models\VL_Status;
use Illuminate\Database\Seeder;
use App\Models\User; 


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolesPermissionsSeeder::class);
        $avp = User::create([
            "name"=>'avp',
            'instansi'=> 'avp Corp',
            'no_badge' => 123,
            'email'=>'avp@gmail.com',
            'password' => bcrypt('123')
        ]);
        $avp->assignRole('avp');

        $vp = User::create([
            "name"=>'vp',
            'instansi'=> 'vp Corp',
            'no_badge' => 123,
            'email'=>'vp@gmail.com',
            'password' => bcrypt('123')
        ]);
        $vp->assignRole('vp');

        $user = User::create([
            "name"=>'user',
            'instansi'=> 'User Corp',
            'no_badge' => 123,
            'email'=>'user@gmail.com',
            'password' => bcrypt('123')
        ]);
        $user->assignRole('user');

        VL_JenisPengajuan::insert([
            ["nama" => 'Pembuatan', "created_at" => now(), "updated_at" => now()],
            ["nama" => 'Pembaruan', "created_at" => now(), "updated_at" => now()],
        ]);

        VL_Status::insert([
            ["name" => 'Approved', "created_at" => now(), "updated_at" => now()],
            ["name" => 'Revise', "created_at" => now(), "updated_at" => now()],
            ["name" => 'Reject', "created_at" => now(), "updated_at" => now()],
            ["name" => 'Review', "created_at" => now(), "updated_at" => now()],
        ]);

        VL_JenisUjian::insert([
            ["nama" => 'SIMPER', "created_at" => now(), "updated_at" => now()],
            ["nama" => 'SIOPAR', "created_at" => now(), "updated_at" => now()],
        ]);

        VL_Durasi::insert([
            ["nama" => '1 Tahun', "created_at" => now(), "updated_at" => now()],
            ["nama" => '6 Bulan', "created_at" => now(), "updated_at" => now()],
            ["nama" => 'Sementara', "created_at" => now(), "updated_at" => now()],
            ["nama" => 'Insidentil', "created_at" => now(), "updated_at" => now()],
        ]);

        Ujian::insert([
            ["nama" => "SIMPER PEMBUATAN", "id_jenis_ujian" => 1, "created_at" => now(), "updated_at" => now()],
            ["nama" => "SIMPER PEMBARUAN", "id_jenis_ujian" => 1, "created_at" => now(), "updated_at" => now()],
            ["nama" => "SIOPAR PEMBUATAN", "id_jenis_ujian" => 2, "created_at" => now(), "updated_at" => now()],
            ["nama" => "SIOPAR PEMBARUAN", "id_jenis_ujian" => 2, "created_at" => now(), "updated_at" => now()],
        ]);

        Soal::insert([
            ["teks" => "IKAN GORENG?", "id_ujian" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        Jawaban::insert([
            ["teks" => "ENAK", "value" => true, "id_soal" => 1, "created_at" => now(), "updated_at" => now()],
            ["teks" => "Enak Kali", "value" => false, "id_soal" => 1, "created_at" => now(), "updated_at" => now()],
            ["teks" => "Gak enak kali", "value" => false, "id_soal" => 1, "created_at" => now(), "updated_at" => now()],
            ["teks" => "HUEKKK", "value" => false, "id_soal" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        PengajuanSimper::insert([
            [
                "id_user"=> 1,
                "id_ujian"=> 1,
                "nama"=> "tes",
                "diterima_tgl"=> now(),
                "dari"=> "tes",
                "perihal"=> "tes",
                "no_surat"=> 123,
                "no_agenda"=> 123,
                "no_badge"=> 123,
                "jenis_simper"=> "tes",
                "surat_permohonan"=> "tes",
                "simpol"=> "tes",
                "badge"=> "tes",
                "spk"=> "tes",
                "keterangan"=> "tes",
                "status_avp"=>4,
                "status_vp"=> 4,
                "id_jenis_pengajuan"=>1,
                "created_at" => now(), 
                "updated_at" => now()
            ]
        ]);

        PengajuanStiker::insert([
            [
                "id_user"=> 1,
                "id_durasi"=> 1,
                "nama"=> "tes",
                "diterima_tgl"=> now(),
                "dari"=> "tes",
                "perihal"=> "tes",
                "no_surat"=> 123,
                "no_agenda"=> 123,
                "no_badge"=> 123,
                "surat_permohonan"=> "tes",
                "spk"=> "tes",
                "stnk"=> "tes",
                "simpol"=> "tes",
                "badge"=> "tes",
                "buku"=> "tes",
                "pajak"=> "tes",
                "keterangan"=> "tes",
                "status_avp"=>4,
                "status_vp"=> 4,
                "created_at" => now(), 
                "updated_at" => now()
            ]
        ]);
        
    }
}

// 'diterima_tgl' => ['required'],
//                 'id_user',
//                 'nama' => ['required'],
//                 'dari' => ['required'],
//                 'perihal' => ['required'],
//                 'id_durasi' => ['required'],
//                 'no_surat' => ['required'],
//                 'no_agenda' => ['required'],
//                 'no_badge' => ['required'],
//                 'surat_permohonan' => ['required', 'mimes:pdf,jpg,png'],
//                 'spk' => ['required', 'mimes:pdf,jpg,png'],
//                 'stnk' => ['required', 'mimes:pdf,jpg,png'],
//                 'simpol' => ['required', 'mimes:pdf,jpg,png'],
//                 'badge' => ['required', 'mimes:pdf,jpg,png'],
//                 'buku' => ['required', 'mimes:pdf,jpg,png'],
//                 'pajak' => ['required', 'mimes:pdf,jpg,png'],
//                 'keterangan',