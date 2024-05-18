<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PengajuanStiker;
use App\Models\VL_Durasi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Ujian;


class PengajuanStikerController extends Controller
{
    public function index()
    {   
        return view('pengajuanStikerIndex');
    }

    public function create()
    {   
        $durasis = VL_Durasi::all();
        return view('pengajuanStikerCreate', compact("durasis"));
    }

    public function edit($id)
    {   
        $pstiker = PengajuanStiker::find($id);
        $durasis = VL_Durasi::all();
        $user = Auth::user();
        if ($user->hasRole('user')) {
            if ($pstiker->id_user !== $user->id){
                return redirect()->back()->with('error', 'Anda tidak diizinkan mengakses pengajuan ini.');
            }
        }
        return view('pengajuanStikerEdit    ', compact("pstiker","durasis"));
    }

    

    public function show($id)
    {
        $pstiker = PengajuanStiker::find($id);
        $user = Auth::user();
        if ($user->hasRole('user')) {
            if ($pstiker->id_user !== $user->id){
                return redirect()->back()->with('error', 'Anda tidak diizinkan mengakses pengajuan ini.');
            }
        }
        $pembayaran = Pembayaran::find($pstiker->id_pembayaran);
        return view('pengajuanStikerShow', compact('pstiker','pembayaran'));
        
    }

    public function changeStatusAvp(Request $request, $id)
    {
        try {
            $item = PengajuanStiker::find($id);
            $the_status = intval($request->status_avp);
            $user = Auth::user();
            if ($user->hasRole('avp')) {
                $item->status_avp = $the_status;
            }elseif ($user->hasRole('vp')) {
                $item->status_vp = $the_status;
            }

            if ($the_status == 1){
                if ($item->status_avp == $item->status_avp){
                    $item->keterangan = "Lakukan Tahap Selanjutnya";
                }else{
                    $item->keterangan = "Diproses";
                }
                
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


    public function store(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'diterima_tgl' => ['required'],
                'id_user',
                'nama' => ['required'],
                'dari' => ['required'],
                'perihal' => ['required'],
                'id_durasi' => ['required'],
                'no_surat' => ['required'],
                'no_agenda' => ['required'],
                'no_badge' => ['required'],
                'surat_permohonan' => ['required', 'mimes:pdf,jpg,png'],
                'spk' => ['required', 'mimes:pdf,jpg,png'],
                'stnk' => ['required', 'mimes:pdf,jpg,png'],
                'simpol' => ['required', 'mimes:pdf,jpg,png'],
                'badge' => ['required', 'mimes:pdf,jpg,png'],
                'buku' => ['required', 'mimes:pdf,jpg,png'],
                'pajak' => ['required', 'mimes:pdf,jpg,png'],
                'keterangan',
            ]);
            $credentials['id_user'] = Auth::id();
            $credentials['keterangan'] = 'Akan di proses';

            // Fungsi untuk mendapatkan nama file yang unik dengan ekstensi
            $getUniqueFileName = function ($prefix, $extension) {
                return $prefix . '_' . md5(uniqid()) . '.' . $extension;
            };

            if ($request->file('surat_permohonan')) {
                $extension = $request->file('surat_permohonan')->getClientOriginalExtension();
                $credentials['surat_permohonan'] = $request->file('surat_permohonan')->storeAs('berkas/stiker', $getUniqueFileName('surat_permohonan', $extension));
            }
            if ($request->file('spk')) {
                $extension = $request->file('spk')->getClientOriginalExtension();
                $credentials['spk'] = $request->file('spk')->storeAs('berkas/stiker', $getUniqueFileName('spk', $extension));
            }
            if ($request->file('stnk')) {
                $extension = $request->file('stnk')->getClientOriginalExtension();
                $credentials['stnk'] = $request->file('stnk')->storeAs('berkas/stiker', $getUniqueFileName('stnk', $extension));
            }
            if ($request->file('simpol')) {
                $extension = $request->file('simpol')->getClientOriginalExtension();
                $credentials['simpol'] = $request->file('simpol')->storeAs('berkas/stiker', $getUniqueFileName('simpol', $extension));
            }
            if ($request->file('badge')) {
                $extension = $request->file('badge')->getClientOriginalExtension();
                $credentials['badge'] = $request->file('badge')->storeAs('berkas/stiker', $getUniqueFileName('badge', $extension));
            }
            if ($request->file('buku')) {
                $extension = $request->file('buku')->getClientOriginalExtension();
                $credentials['buku'] = $request->file('buku')->storeAs('berkas/stiker', $getUniqueFileName('buku', $extension));
            }
            if ($request->file('pajak')) {
                $extension = $request->file('pajak')->getClientOriginalExtension();
                $credentials['pajak'] = $request->file('pajak')->storeAs('berkas/stiker', $getUniqueFileName('pajak', $extension));
            }

            

            PengajuanStiker::create($credentials);
            return redirect()->route('pengajuanstiker.index')->with('success', 'Pengajuan berhasil disimpan!');
        } catch (ValidationException $e) {
            return back()->with('Error', 'Pengajuan Gagal!')->withErrors($e->errors());
        }
    }

    public function update(Request $request,$id): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'diterima_tgl' => ['required'],
                'id_user',
                'nama' => ['required'],
                'dari' => ['required'],
                'perihal' => ['required'],
                'id_durasi' => ['required'],
                'no_surat' => ['required'],
                'no_agenda' => ['required'],
                'no_badge' => ['required'],
                'surat_permohonan' => ['nullable', 'mimes:pdf,jpg,png'],
                'spk' => ['nullable', 'mimes:pdf,jpg,png'],
                'stnk' => ['nullable', 'mimes:pdf,jpg,png'],
                'simpol' => ['nullable', 'mimes:pdf,jpg,png'],
                'badge' => ['nullable', 'mimes:pdf,jpg,png'],
                'buku' => ['nullable', 'mimes:pdf,jpg,png'],
                'pajak' => ['nullable', 'mimes:pdf,jpg,png'],
                'keterangan',
                'status_vp',
                'status_avp',
            ]);
            unset($credentials['id_user']);
            $credentials['id_user'] = Auth::id();
            $credentials['status_vp'] = 4;
            $credentials['status_avp'] = 4;


            // Fungsi untuk mendapatkan nama file yang unik dengan ekstensi
            $getUniqueFileName = function ($prefix, $extension) {
                return $prefix . '_' . md5(uniqid()) . '.' . $extension;
            };

            if ($request->file('surat_permohonan')) {
                $extension = $request->file('surat_permohonan')->getClientOriginalExtension();
                $credentials['surat_permohonan'] = $request->file('surat_permohonan')->storeAs('berkas/stiker', $getUniqueFileName('surat_permohonan', $extension));
            }
            if ($request->file('spk')) {
                $extension = $request->file('spk')->getClientOriginalExtension();
                $credentials['spk'] = $request->file('spk')->storeAs('berkas/stiker', $getUniqueFileName('spk', $extension));
            }
            if ($request->file('stnk')) {
                $extension = $request->file('stnk')->getClientOriginalExtension();
                $credentials['stnk'] = $request->file('stnk')->storeAs('berkas/stiker', $getUniqueFileName('stnk', $extension));
            }
            if ($request->file('simpol')) {
                $extension = $request->file('simpol')->getClientOriginalExtension();
                $credentials['simpol'] = $request->file('simpol')->storeAs('berkas/stiker', $getUniqueFileName('simpol', $extension));
            }
            if ($request->file('badge')) {
                $extension = $request->file('badge')->getClientOriginalExtension();
                $credentials['badge'] = $request->file('badge')->storeAs('berkas/stiker', $getUniqueFileName('badge', $extension));
            }
            if ($request->file('buku')) {
                $extension = $request->file('buku')->getClientOriginalExtension();
                $credentials['buku'] = $request->file('buku')->storeAs('berkas/stiker', $getUniqueFileName('buku', $extension));
            }
            if ($request->file('pajak')) {
                $extension = $request->file('pajak')->getClientOriginalExtension();
                $credentials['pajak'] = $request->file('pajak')->storeAs('berkas/stiker', $getUniqueFileName('pajak', $extension));
            }

            

            PengajuanStiker::find($id)->update($credentials);
            return redirect()->route('pengajuanstiker.show' , ['id' => $id])->with('success', 'Revisi berhasil disimpan!');
        } catch (ValidationException $e) {
            return back()->with('Error', 'Pengajuan Gagal!')->withErrors($e->errors());
        }
    }
}
