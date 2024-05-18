<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use URL;
use Config;
use Carbon\Carbon;
use Exception;
use App\Models\User;
use App\Mail\VerifyEmail;
use Str;


class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'name' => ['required'],
                'instansi' => ['required'],
                'no_badge' => ['required'],
            ]);

            // Buat pengguna baru
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'instansi'=> $request->instansi,
                'no_badge'=> $request->no_badge,
                'password' => Hash::make(Str::random(16)), // Kata sandi acak
                'email_verified_at' => null, // Atur null, karena belum diverifikasi
            ]);
            $user->assignRole('user');

            // Kirim email verifikasi
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );

            Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));
            return view('registerSuccess');
        } catch (Exception $e) {
            return redirect()->back()->with('Error', $e->getMessage());
        }
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password);
            $user->email_verified_at = now();
            $user->save();
            return view('registerResetSuccess');
        } catch (Exception $e) {
            return redirect()->back()->with('Error', $e->getMessage());
        }
        
    }


    public function verifyEmail($id, $hash)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);
        
        // Verifikasi email
        if ($user->email_verified_at !== null) {
            $pesan = 'Akun sudah ter-verifikasi dan password telah diubah';
            return view('registerReset',compact('pesan'));
        }
        

        // Verifikasi hash
        if (sha1($user->email) === $hash) {

            // Kembalikan respons dengan pesan sukses
            return view('registerReset',compact('user'));
        }
        $pesan = 'Terjadi Kesalahan';
        // Jika hash tidak cocok, kembalikan respons dengan pesan error
        return view('registerReset',compact('pesan'));
    }
}
