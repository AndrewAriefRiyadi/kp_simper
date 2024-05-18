<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanStiker;
use Illuminate\Support\Facades\Auth;

class PengajuanStikerApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('user')){
            return PengajuanStiker::where('id_user', $user->id)->get();
        }
        return PengajuanStiker::all();
    }

    // public function show($id)
    // {
    //     $pengajuanSimper = PengajuanSimper::findOrFail($id);
    //     return response()->json($pengajuanSimper);
    // }
}
