<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PengajuanSimper;
use Illuminate\Http\Request;
use App\Models\PengajuanStiker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PembayaranController extends Controller
{
    //

    public function psimper_show($id){
        $psimper = PengajuanSimper::find($id);
        $pembayaran = Pembayaran::find($psimper->id_pembayaran);
        return view("pembayaranSimper", compact("psimper","pembayaran"));
    }

    public function pstiker_show($id){
        $pstiker = PengajuanStiker::find($id);
        return view("pembayaranStiker", compact("pstiker"));
    }

    public function psimper_store(Request $request, $id): RedirectResponse
    {   
        try {
            $credentials = $request->validate([
                "nominal" => "required",
                "metode" => "required",
                "bukti"=> ['required', 'mimes:pdf,jpg,png']
            ]);

            $getUniqueFileName = function ($prefix, $extension) {
                return $prefix . '_' . md5(uniqid()) . '.' . $extension;
            };

            if ($request->file('bukti')) {
                $extension = $request->file('bukti')->getClientOriginalExtension();
                $credentials['bukti'] = $request->file('bukti')->storeAs('berkas/pembayaran', $getUniqueFileName('bukti', $extension));
            }
            $pembayaran = Pembayaran::create($credentials);
            $psimper = PengajuanSimper::find($id);
            $psimper->id_pembayaran = $pembayaran->id;
            $psimper->save();
            return redirect()->route('pengajuansimper.show', ['id' => $id])->with('success', 'Pembayaran berhasil!');
        } catch (\Throwable $th) {
            return back()->with('Error', $th->getMessage());
        }
    }

    public function pstiker_store(Request $request, $id): RedirectResponse
    {   
        try {
            $credentials = $request->validate([
                "nominal" => "required",
                "metode" => "required",
                "bukti"=> ['required', 'mimes:pdf,jpg,png']
            ]);

            $getUniqueFileName = function ($prefix, $extension) {
                return $prefix . '_' . md5(uniqid()) . '.' . $extension;
            };

            if ($request->file('bukti')) {
                $extension = $request->file('bukti')->getClientOriginalExtension();
                $credentials['bukti'] = $request->file('bukti')->storeAs('berkas/pembayaran', $getUniqueFileName('bukti', $extension));
            }
            $pembayaran = Pembayaran::create($credentials);
            $pstiker = PengajuanStiker::find($id);
            $pstiker->id_pembayaran = $pembayaran->id;
            $pstiker->save();
            return redirect()->route('pengajuanstiker.show', ['id' => $id])->with('success', 'Pembayaran berhasil!');
        } catch (\Throwable $th) {
            return back()->with('Error', $th->getMessage());
        }
    }
}
