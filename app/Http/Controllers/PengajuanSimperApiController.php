<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSimper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanSimperApiController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        if($user->hasRole('user')){
            return PengajuanSimper::where('id_user', $user->id)->get();
        }
        return PengajuanSimper::all();
    }

    public function show($id)
    {
        $pengajuanSimper = PengajuanSimper::findOrFail($id);
        return response()->json($pengajuanSimper);
    }
}
