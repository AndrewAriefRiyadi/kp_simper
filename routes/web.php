<?php

use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengajuanSimperController;
use App\Http\Controllers\PengajuanStikerApiController;
use App\Http\Controllers\PengajuanStikerController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UsersApiController;
use App\Http\Controllers\UsersController;
use App\Models\PengajuanSimper;
use App\Models\Ujian;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengajuanSimperApiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth'])->group(function () {
    Route::apiResource('pengajuansimperAPI', PengajuanSimperApiController::class);
    Route::get('/pengajuansimper',[PengajuanSimperController::class,'index'])->name('pengajuansimper.index');
    Route::get('/pengajuansimper/{id}', [PengajuanSimperController::class, 'show'])->name('pengajuansimper.show');
    Route::get('/pengajuansimper/{id}/edit', [PengajuanSimperController::class, 'edit'])->name('pengajuansimper.edit');
    Route::put('/pengajuansimper/{id}/edit', [PengajuanSimperController::class, 'update'])->name('pengajuansimper.update');
    Route::get('/pengajuansimperCreate',[PengajuanSimperController::class,'create'])->name('pengajuansimper.create');
    Route::post('/pengajuansimperCreate',[PengajuanSimperController::class,'store'])->name('pengajuansimper.store');
    Route::post('/pengajuansimper/{id}/changeUjian',[PengajuanSimperController::class,'changeUjian'])->name('pengajuansimper.changeUjian');
    Route::put('/pengajuansimper/{id}/changeStatusAvp',[PengajuanSimperController::class,'changeStatusAvp'])->name('pengajuansimper.changeStatusAvp');
    Route::get('/pengajuansimper/{id}/ujian/prepare',[UjianController::class,'prepare'])->name('pengajuansimper.ujian.prepare');
    Route::get('/pengajuansimper/{id}/ujian/simulasi',[UjianController::class,'psimper_simulasi'])->name('pengajuansimper.ujian.simulasi');
    Route::get('/pengajuansimper/{id}/ujian/result',[UjianController::class,'psimper_result'])->name('pengajuansimper.ujian.result');
    Route::get('/pengajuansimper/{id}/pembayaran',[PembayaranController::class,'psimper_show'])->name('pengajuansimper.pembayaran.show');
    Route::post('/pengajuansimper/{id}/pembayaran',[PembayaranController::class,'psimper_store'])->name('pengajuanstiker.pembayaran.store');
    // ROUTING UJIAN, SOAL, JAWABAN GAMING
    Route::middleware(['role:avp|vp'])->group(function () {
        Route::get('/ujian',[UjianController::class,'index'])->name('ujian.index');
        Route::get('/ujian/create',[UjianController::class,'create'])->name('ujian.create');
        Route::post('/ujian/create',[UjianController::class,'store'])->name('ujian.store');
        Route::get('/ujian/{id}',[UjianController::class,'show'])->name('ujian.show');
        Route::get('/ujian/{id}/create',[UjianController::class,'createSoal'])->name('ujian.createSoal');
        Route::get('/ujian/{id1}/edit/{id2}',[UjianController::class,'editSoal'])->name('ujian.editSoal');
        Route::put('/ujian/{id1}/edit/{id2}',[UjianController::class,'updateSoal'])->name('ujian.updateSoal');
        Route::post('/ujian/{id}/create',[UjianController::class,'storeSoal'])->name('ujian.storeSoal');
        Route::delete('/ujian/soal/{id}',[UjianController::class,'deleteSoal'])->name('ujian.deleteSoal');

        Route::apiResource('usersAPI', UsersApiController::class);
        Route::get('/users',[UsersController::class,'index'])->name('users.index');
        
        
    });
    Route::get('/users/{id}',[UsersController::class,'show'])->name('users.show');
    Route::get('/users/{id}/edit',[UsersController::class,'edit'])->name('users.edit');
    Route::put('/users/{id}/edit',[UsersController::class,'update'])->name('users.update');
    
    Route::get('/ujian/{id}/simulasi',[UjianController::class,'simulasi'])->name('ujian.simulasi');
    Route::post('/ujianSubmit/{id}',[UjianController::class,'submit'])->name('ujian.submit');
    Route::post('/simpan_jawaban', [UjianController::class,'simpanJawaban']);

    Route::apiResource('pengajuanStikerAPI', PengajuanStikerApiController::class);
    Route::get('/pengajuanstiker',[PengajuanStikerController::class,'index'])->name('pengajuanstiker.index');
    Route::get('/pengajuanstiker/create',[PengajuanStikerController::class,'create'])->name('pengajuanstiker.create');
    Route::post('/pengajuanstiker/create',[PengajuanStikerController::class,'store'])->name('pengajuanstiker.store');
    Route::get('/pengajuanstiker/{id}', [PengajuanStikerController::class, 'show'])->name('pengajuanstiker.show');
    Route::get('/pengajuanstiker/{id}/edit', [PengajuanStikerController::class, 'edit'])->name('pengajuanstiker.edit');
    Route::put('/pengajuanstiker/{id}/edit', [PengajuanStikerController::class, 'update'])->name('pengajuanstiker.update');
    Route::put('/pengajuanstiker/{id}/changeStatusAvp',[PengajuanStikerController::class,'changeStatusAvp'])->name('pengajuanstiker.changeStatusAvp');
    Route::get('/pengajuanstiker/{id}/pembayaran',[PembayaranController::class,'pstiker_show'])->name('pengajuanstiker.pembayaran.show');
    Route::post('/pengajuanstiker/{id}/pembayaran',[PembayaranController::class,'pstiker_store'])->name('pengajuanstiker.pembayaran.store');

    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/tes',function(){
        $data = PengajuanSimper::all();
        return view('tes', compact('data'));
    });
});

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return view('welcome', compact('user'));
    }
    return view('login');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [LoginController::class, 'register']);
    Route::post('/register', [LoginController::class, 'store']);
    Route::put('/register/reset/{id}', [LoginController::class, 'update']);

    Route::post('/login', [LoginController::class, 'authenticate']);

    Route::get('/verify-email/{id}/{hash}', [LoginController::class, 'verifyEmail'])->name('verification.verify');
});
