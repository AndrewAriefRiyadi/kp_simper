<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function index(){
        return view("usersIndex");
    }

    public function show($id){
        $user = User::find($id);
        $user_now = Auth::user();
        if ($user_now->hasRole('user')){
            if($user->id == Auth::user()->id){
                return view("usersShow", compact("user"));
            }
            else{
                return redirect("/");
            }
        }else{
            return view("usersShow", compact("user"));
        }
        
        
    }

    public function edit($id){
        $user = User::find($id);
        $user_now = Auth::user();
        if ($user_now->hasRole('user')){
            if($user->id == Auth::user()->id){
                return view("usersEdit", compact("user"));
            }
            else{
                return redirect("/");
            }
        }else{
            return view("usersEdit", compact("user"));
        }
    }

    public function update(Request $request , $id){
        $user = User::find($id);
        $user_now = Auth::user();
        if ($user_now->hasRole('user')){
            if($user->id != Auth::user()->id){
                return redirect("/");
            }
        }

        try {
            $credentials = $request->validate([
                'name' => ['required'],
                'instansi' => ['required'],
                'no_badge' => ['required'],
            ]);
            User::find($id)->update($credentials);
            return redirect()->route('users.show' , ['id' => $id])->with('success', 'Perubahan berhasil disimpan!');
        } catch (ValidationException $e) {
            return back()->with('Error', 'Perubahan Gagal!')->withErrors($e->errors());
        }
    }
}