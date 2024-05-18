<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersApiController extends Controller
{
    public function index()
    {   
        return User::all();
    }

    public function show($id)
    {
        $pengajuanSimper = User::findOrFail($id);
        return response()->json($pengajuanSimper);
    }
}
