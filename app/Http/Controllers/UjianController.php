<?php

namespace App\Http\Controllers;

use App\Models\ModulPusim;
use App\Models\Pembayaran;
use App\Models\PengajuanSimper;
use App\Models\Pusim;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\VL_JenisUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class UjianController extends Controller
{
    public function index()
    {
        $ujian = Ujian::all();
        return view("ujianIndex", compact('ujian'));
    }

    public function create()
    {
        $jenisUjians = VL_JenisUjian::all();
        return view("ujianCreate", compact("jenisUjians"));
    }


    public function store(Request $request)
    {
        try {
            $credentials = $request->validate([
                "nama" => "required",
                "id_jenis_ujian" => "required"
            ]);

            Ujian::create($credentials);
            return redirect()->route('ujian.index')->with('success', 'Create Ujian berhasil!');
        } catch (\Throwable $th) {
            return back()->with('Error', $th->getMessage());
        }
    }

    public function createSoal($id)
    {
        $ujian = Ujian::find($id);
        return view("ujianCreateSoal", compact('ujian'));
    }

    public function editSoal($id1, $id2){
        $ujian = Ujian::find($id1);
        $soal = Soal::find($id2);
        $jawabans = Jawaban::where('id_soal' ,$soal->id)->get();
        return view('ujianEditSoal', compact('ujian','soal','jawabans'));
    }

    public function deleteSoal($id)
    {
        $soal = soal::find($id);
        $soal->delete();
        return back()->with('success','Soal Berhasil Dihapus');
    }

    public function storeSoal(Request $request, $id)
    {
        try {
            $credentials = $request->validate([
                'teks_soal' => ['required'],
                'teks_jawaban_a' => ['required'],
                'teks_jawaban_b' => ['required'],
                'teks_jawaban_c' => ['required'],
                'teks_jawaban_d' => ['required'],
                'jawaban_benar' => ['required'],
            ]);
            $soal = Soal::create([
                "teks" => $credentials['teks_soal'],
                "id_ujian" => $id,
            ]);

            Jawaban::insert([
                ["teks" => $credentials['teks_jawaban_a'], "value" => ($credentials['jawaban_benar'] == 'A') ? 1 : 0, "id_soal" => $soal->id, "created_at" => now(), "updated_at" => now()],
                ["teks" => $credentials['teks_jawaban_b'], "value" => ($credentials['jawaban_benar'] == 'B') ? 1 : 0, "id_soal" => $soal->id, "created_at" => now(), "updated_at" => now()],
                ["teks" => $credentials['teks_jawaban_c'], "value" => ($credentials['jawaban_benar'] == 'C') ? 1 : 0, "id_soal" => $soal->id, "created_at" => now(), "updated_at" => now()],
                ["teks" => $credentials['teks_jawaban_d'], "value" => ($credentials['jawaban_benar'] == 'D') ? 1 : 0, "id_soal" => $soal->id, "created_at" => now(), "updated_at" => now()],
            ]);


            return redirect()->route('ujian.show', ['id' => $id])->with('success', 'Soal berhasil disimpan!');
        } catch (ValidationException $e) {
            return back()->with('Error', 'Pengajuan Gagal!')->withErrors($e->errors());
        }
    }

    public function updateSoal(Request $request, $id1,$id2)
    {
        try {
            $credentials = $request->validate([
                'teks_soal' => ['required'],
                'teks_jawaban_a' => ['required'],
                'teks_jawaban_b' => ['required'],
                'teks_jawaban_c' => ['required'],
                'teks_jawaban_d' => ['required'],
                'jawaban_benar' => ['required'],
            ]);
            $soal = Soal::find($id2);
            $soal->teks = $credentials['teks_soal'];
            $soal->save();
            
            $jawabansBaru = [$credentials['teks_jawaban_a'],$credentials['teks_jawaban_b'],$credentials['teks_jawaban_c'],$credentials['teks_jawaban_d']];
            $jawabans = Jawaban::where('id_soal' ,$soal->id)->get();
            foreach ($jawabans as $key => $jawaban) {
                $jawaban->teks = $jawabansBaru[$key];
                if ($credentials['jawaban_benar'] == $key){
                    $jawaban->value = 1;
                }else {
                    $jawaban->value = 0;
                }
                $jawaban->save();
            }

            return redirect()->route('ujian.show', ['id' => $id1])->with('success', 'Soal berhasil diRubah!');
        } catch (ValidationException $e) {
            return back()->with('Error', 'Perubahan Soal GAGAL!')->withErrors($e->errors());
        }
    }

    public function show($id)
    {
        $ujian = Ujian::find($id);

        // Mendapatkan soal-soal dengan id_ujian yang sesuai
        $soals = Soal::where('id_ujian', $id)->paginate(5);

        // Membuat array untuk menyimpan jawaban-jawaban
        $jawabans = [];

        // Loop melalui setiap soal untuk mendapatkan jawaban-jawaban yang sesuai
        foreach ($soals as $soal) {
            $jawabans[$soal->id] = Jawaban::where('id_soal', $soal->id)->get();
        }

        // Mengirim data ke view
        return view("ujianShow", compact('ujian', 'soals', 'jawabans'));
    }

    public function prepare($id)
    {
        $psimper = PengajuanSimper::find($id);
        $id_user = Auth::id();
        if ($psimper->id_user != $id_user){
            return redirect()->route("pengajuansimper.index");
        }
        $ujian = Ujian::where('id', $psimper->id_ujian)->first();
        $pusim = Pusim::where('id_pengajuan_simper', $id)->first();
        $soals = Soal::where('id_ujian', $ujian->id)->count();
        return view('ujianPrepare', compact('psimper', 'ujian', 'pusim','soals'));

    }

    public function psimper_simulasi($id)
    {

        $psimper = PengajuanSimper::find($id);
        $ujian = Ujian::find($psimper->id_ujian);
        $soals = Soal::where('id_ujian', $ujian->id)->get();

        if (Pusim::where('id_pengajuan_simper', $id)->count() >= 1) {
            $pusim = Pusim::where('id_pengajuan_simper', $id)->first();
            $moduls = ModulPusim::where('id_pusim', $pusim->id)->get();
        } else {
            $pusim = Pusim::create(['id_pengajuan_simper' => $id]);
            $soalsArray = $soals->shuffle()->all();
            foreach ($soalsArray as $soalAcak) {
                ModulPusim::create([
                    'id_pusim' => $pusim->id,
                    'id_soal' => $soalAcak->id
                ]);
            }
            $moduls = ModulPusim::where('id_pusim', $pusim->id)->get();
        }

        // Menggunakan pluck untuk mendapatkan array dari kolom id_soal
        $idSoals = $moduls->pluck('id_soal')->toArray();

        // Mengambil soal-soal yang terkait dengan modul
        $soals = Soal::whereIn('id', $idSoals)
            ->orderByRaw("FIELD(id, " . implode(',', $idSoals) . ")")
            ->paginate(1);

        return view('ujianSimulasi', compact('soals', 'moduls', 'ujian', 'pusim'));

    }

    public function simpanJawaban(Request $request)
    {
        // Validasi request jika diperlukan
        $jawaban_id = $request->input('jawaban');
        $id_soal = $request->input('id_soal');
        $id_pusim = $request->input('id_pusim');
        $modul = ModulPusim::where('id_pusim', $id_pusim)
            ->where('id_soal', $id_soal);
        $modul->update(['id_jawaban' => $jawaban_id]);

    }

    public function submit($id)
    {
        $pusim = Pusim::find($id);
        $moduls = ModulPusim::where('id_pusim', $pusim->id)->get();

        $jawabans = collect(); // Initialize a collection to store Jawaban instances

        foreach ($moduls as $modul) {
            // Fetch Jawaban instances based on id_jawaban
            $jawaban = Jawaban::find($modul->id_jawaban);

            // Add Jawaban instance to the collection
            $jawabans->push($jawaban);
        }

        $jawabans_benar = 0;
        foreach ($jawabans as $jawaban) {
            if ($jawaban->value == 1) {
                $jawabans_benar++;
            }
        }

        $total_moduls = $moduls->count();
        // Calculate the percentage
        $percentage = ($jawabans_benar / $total_moduls) * 100;

        // Round the percentage to two decimal places
        $percentage = round($percentage, 2);

        // Output the percentage
        $pusim->nilai = $percentage;
        $pusim->save();

        $psimper = PengajuanSimper::where('id', $pusim->id_pengajuan_simper)->first();

        if($pusim->nilai < 70){
            $psimper->status_vp = 3;
            $psimper->keterangan = "Tidak Lulus";
            $psimper->save();
        }else{
            $psimper->keterangan = "Telah Ujian";
            $psimper->save();
        }
        return redirect()->route('pengajuansimper.show', ['id' => $psimper->id]);
    }

    public function psimper_result($id)
    {
        $psimper = PengajuanSimper::find($id);
        $ujian = Ujian::find($psimper->id_ujian);
        $pusim = Pusim::where('id_pengajuan_simper', $id)->first();
        $moduls = ModulPusim::where('id_pusim', $pusim->id)->get();

        // Menggunakan pluck untuk mendapatkan array dari kolom id_soal
        $idSoals = $moduls->pluck('id_soal')->toArray();

        // Mengambil soal-soal yang terkait dengan modul
        $soals = Soal::whereIn('id', $idSoals)
            ->orderByRaw("FIELD(id, " . implode(',', $idSoals) . ")")
            ->paginate(1);

        return view('ujianResult', compact('soals', 'moduls', 'ujian', 'pusim'));


    }
}
