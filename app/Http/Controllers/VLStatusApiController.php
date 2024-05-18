<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VL_Status; // Pastikan menggunakan nama model yang benar

class VLStatusApiController extends Controller
{
    public function getStatus($id){
        $vl_status = VL_Status::find($id);
        return $vl_status->name;
    }
}
