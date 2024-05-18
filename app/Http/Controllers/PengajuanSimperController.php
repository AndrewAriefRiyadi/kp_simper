<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSimper;
use App\Models\Pusim;
use App\Models\Ujian;
use App\Models\VL_JenisPengajuan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class PengajuanSimperController extends Controller
{
    public function index()
    {   

        return view('pengajuansimperIndex');
    }
    
    public function show($id)
    {
        $pengajuanSimper = PengajuanSimper::find($id);
        $user = Auth::user();
        if ($user->hasRole('user')) {
            if ($pengajuanSimper->id_user !== $user->id){
                return redirect()->back()->with('error', 'Anda tidak diizinkan mengakses pengajuan ini.');
            }
        }
        $ujians = Ujian::find($pengajuanSimper->id_ujian);
        $pusim = Pusim::where('id_pengajuan_simper', $pengajuanSimper->id)->first();
        $jenis_pengajuan = VL_JenisPengajuan::where('id', $pengajuanSimper->id_jenis_pengajuan)->first();
        $pembayaran = Pembayaran::find($pengajuanSimper->id_pembayaran);
        if ($pusim){
            return view('pengajuansimperShow', compact('pengajuanSimper','ujians','pusim','jenis_pengajuan','pembayaran'));
        }else{
            return view('pengajuansimperShow', compact('pengajuanSimper','ujians','jenis_pengajuan'));
        }
    }

    public function create()
    {
        return view('pengajuansimperCreate');
    }

    public function edit($id)
    {
        $psimper = PengajuanSimper::find($id);
        $user = Auth::user();
        if ($user->hasRole('user')) {
            if ($psimper->id_user !== $user->id){
                return redirect()->back()->with('error', 'Anda tidak diizinkan mengakses pengajuan ini.');
            }
        }
        return view('pengajuansimperEdit', compact('psimper'));
    }

    public function changeStatusAvp(Request $request, $id)
    {
        try {
            $item = PengajuanSimper::find($id);
            $the_status = intval($request->status_avp);
            $user = Auth::user();
            
            if ($user->hasRole('avp')) {
                $item->status_avp = $the_status;
            }elseif ($user->hasRole('vp')) {
                $item->status_vp = $the_status;
            }
            
            if ($the_status == 1){
                $item->keterangan = "Lakukan Tahap Selanjutnya";
            }elseif ($the_status == 2) {
                $item->keterangan = $request->keterangan;
            }elseif ($the_status == 3){
                $item->keterangan = "Ditolak";
            }
            
            if ($request->keterangan_revisi){
                $item->keterangan_revisi = $request->keterangan_revisi;
            }
            $item->save();
            return redirect()->back()->with('success', 'Status AVP Berhasil Diubah');
        } catch (\Throwable $th) {
            return back()->with('Error', 'Validasi Gagal!');
        }

    }

    public function changeUjian(Request $request, $id)
    {   
        try {
            $item = PengajuanSimper::find($id);
            if ($request->id_ujian != null) {
            $item->id_ujian = $request->id_ujian;
            } else {
                $item->id_ujian = null;
            }
            $item->save();
            return redirect()->back()->with('success', 'Ujian berhasil diubah!');
        } catch (\Throwable $th) {
            return back()->with('Error', 'Ubah Ujian Gagal!');
        }

    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'diterima_tgl' => ['required'],
                'id_user',
                'id_ujian',
                'nama' => ['required'],
                'dari' => ['required'],
                'perihal' => ['required'],
                'no_surat' => ['required'],
                'no_agenda' => ['required'],
                'no_badge' => ['required'],
                'jenis_simper' => ['nullable'],
                'surat_permohonan' => ['required', 'mimes:pdf,jpg,png'],
                'simpol' => ['required', 'mimes:pdf,jpg,png'],
                'badge' => ['required', 'mimes:pdf,jpg,png'],
                'spk' => ['mimes:pdf,jpg,png'],
                'keterangan',
                'id_jenis_pengajuan' => ['required'],
                'simper_lama' => ['mimes:pdf,jpg,png'],
            ]);
            $credentials['id_user'] = Auth::id();
            $credentials['keterangan'] = 'Akan di Proses';
            if ($credentials['id_jenis_pengajuan'] == 1) {
                if($credentials['perihal']=="SIMPER"){
                    $credentials['id_ujian'] = 1;
                }else{
                    $credentials['id_ujian'] = 3;
                }
                
            }else{
                if($credentials['perihal']=="SIMPER"){
                    $credentials['id_ujian'] = 2;
                }else{
                    $credentials['id_ujian'] = 4;
                }
            }

            // Fungsi untuk mendapatkan nama file yang unik dengan ekstensi
            $getUniqueFileName = function ($prefix, $extension) {
                return $prefix . '_' . md5(uniqid()) . '.' . $extension;
            };

            if ($request->file('surat_permohonan')) {
                $extension = $request->file('surat_permohonan')->getClientOriginalExtension();
                $credentials['surat_permohonan'] = $request->file('surat_permohonan')->storeAs('berkas/simper', $getUniqueFileName('surat_permohonan', $extension));
            }

            if ($request->file('simpol')) {
                $extension = $request->file('simpol')->getClientOriginalExtension();
                $credentials['simpol'] = $request->file('simpol')->storeAs('berkas/simper', $getUniqueFileName('simpol', $extension));
            }

            if ($request->file('badge')) {
                $extension = $request->file('badge')->getClientOriginalExtension();
                $credentials['badge'] = $request->file('badge')->storeAs('berkas/simper', $getUniqueFileName('badge', $extension));
            }

            if ($request->file('spk')) {
                $extension = $request->file('spk')->getClientOriginalExtension();
                $credentials['spk'] = $request->file('spk')->storeAs('berkas/simper', $getUniqueFileName('spk', $extension));
            }

            if ($request->file('simper_lama')) {
                $extension = $request->file('simper_lama')->getClientOriginalExtension();
                $credentials['simper_lama'] = $request->file('simper_lama')->storeAs('berkas/simper', $getUniqueFileName('simper_lama', $extension));
            }

            PengajuanSimper::create($credentials);
            return redirect()->route('pengajuansimper.index')->with('success', 'Pengajuan berhasil disimpan!');
        } catch (ValidationException $e) {
            return back()->with('Error', 'Pengajuan Gagal!')->withErrors($e->errors());
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'diterima_tgl' => ['required'],
                'id_user',
                'id_ujian',
                'nama' => ['required'],
                'dari' => ['required'],
                'perihal' => ['required'],
                'no_surat' => ['required'],
                'no_agenda' => ['required'],
                'no_badge' => ['required'],
                'jenis_simper' => ['nullable'],
                'surat_permohonan' => ['nullable', 'mimes:pdf,jpg,png'],
                'simpol' => ['nullable', 'mimes:pdf,jpg,png'],
                'badge' => ['nullable', 'mimes:pdf,jpg,png'],
                'spk' => ['mimes:pdf,jpg,png'],
                'keterangan',
                'id_jenis_pengajuan' => ['required'],
                'simper_lama' => ['mimes:pdf,jpg,png'],
                'status_vp',
                'status_avp'
            ]);
            unset($credentials['id_user']);
            $credentials['status_vp'] = 4;
            $credentials['status_avp'] = 4;
            $credentials['keterangan'] = "Telah Revisi";

            if ($credentials['id_jenis_pengajuan'] == 1) {
                if($credentials['perihal']=="SIMPER"){
                    $credentials['id_ujian'] = 1;
                }else{
                    $credentials['id_ujian'] = 3;
                }
                
            }else{
                if($credentials['perihal']=="SIMPER"){
                    $credentials['id_ujian'] = 2;
                }else{
                    $credentials['id_ujian'] = 4;
                }
            }

            // Fungsi untuk mendapatkan nama file yang unik dengan ekstensi
            $getUniqueFileName = function ($prefix, $extension) {
                return $prefix . '_' . md5(uniqid()) . '.' . $extension;
            };

            if ($request->file('surat_permohonan')) {
                $extension = $request->file('surat_permohonan')->getClientOriginalExtension();
                $credentials['surat_permohonan'] = $request->file('surat_permohonan')->storeAs('berkas/simper', $getUniqueFileName('surat_permohonan', $extension));
            }

            if ($request->file('simpol')) {
                $extension = $request->file('simpol')->getClientOriginalExtension();
                $credentials['simpol'] = $request->file('simpol')->storeAs('berkas/simper', $getUniqueFileName('simpol', $extension));
            }

            if ($request->file('badge')) {
                $extension = $request->file('badge')->getClientOriginalExtension();
                $credentials['badge'] = $request->file('badge')->storeAs('berkas/simper', $getUniqueFileName('badge', $extension));
            }

            if ($request->file('spk')) {
                $extension = $request->file('spk')->getClientOriginalExtension();
                $credentials['spk'] = $request->file('spk')->storeAs('berkas/simper', $getUniqueFileName('spk', $extension));
            }

            if ($request->file('simper_lama')) {
                $extension = $request->file('simper_lama')->getClientOriginalExtension();
                $credentials['simper_lama'] = $request->file('simper_lama')->storeAs('berkas/simper', $getUniqueFileName('simper_lama', $extension));
            }

            PengajuanSimper::find($id)->update($credentials);
            return redirect()->route('pengajuansimper.show' , ['id' => $id])->with('success', 'Revisi berhasil disimpan!');
        } catch (ValidationException $e) {
            return back()->with('Error', 'Pengajuan Gagal!')->withErrors($e->errors());
        }
    }
}
