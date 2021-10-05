<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaprogdiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TataUsahaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[PageController::class,'index'])->name('login')->middleware('guest');
Route::post('/',[PageController::class,'login']);
Route::post('/register',[PageController::class,'reg'])->name('reg');
Route::get('/register',[PageController::class,'register'])->name('register')->middleware('guest');
Route::get('/logout',[PageController::class,'logout'])->name('logout');

// mahasiswa
Route::get('/home',[HomeController::class,'index'])->name('home')->middleware('auth');
Route::post('/request',[HomeController::class,'request_surat'])->name('request_surat')->middleware('auth');
Route::get('/profile',[MahasiswaController::class,'index'])->name('profile')->middleware('auth');
Route::post('/akun',[MahasiswaController::class,'akun'])->name('akun')->middleware('auth');

// dosen
Route::get('/dashboard',[DosenController::class,'index'])->name('dashobard')->middleware('auth');
Route::post('/request-surat',[DosenController::class,'request_dosen'])->name('request_dosen')->middleware('auth');
Route::get('/profile-dosen',[DosenController::class,'profile'])->name('profile_dosen')->middleware('auth');
Route::post('/akun-dosen',[DosenController::class,'akun_dosen'])->name('akun-dosen')->middleware('auth');

// kaprogdi
Route::get('/rumah',[KaprogdiController::class,'index'])->name('rumah')->middleware('auth');
Route::get('/rumah-dosen',[KaprogdiController::class,'rumah_dosen'])->name('rumah-dosen')->middleware('auth');
Route::get('/profil-kaprogdi',[KaprogdiController::class,'profile_kaprogdi'])->name('profile-kaprogdi')->middleware('auth');
Route::post('/upload-kaprogdi',[TataUsahaController::class,'upload_kaprogdi'])->name('upload-kaprogdi')->middleware('auth');
Route::get('/download-kaprogdi/{file_name}',[TataUsahaController::class,'download'])->name('download-kaprogdi')->middleware('auth');

// tu
Route::get('/base',[TataUsahaController::class,'index'])->name('base')->middleware('auth');
Route::post('/upload-tu',[TataUsahaController::class,'upload_tu'])->name('upload-tu')->middleware('auth');
Route::get('/download-berkas/{file_name}',[TataUsahaController::class,'download'])->name('download-file')->middleware('auth');
Route::get('/base-dosen',[TataUsahaController::class,'base_dosen'])->name('base-dosen')->middleware('auth');
Route::get('/base-akun',[TataUsahaController::class,'base_akun'])->name('base-akun')->middleware('auth');
Route::post('/base-update',[TataUsahaController::class,'base_update'])->name('base-update')->middleware('auth');

// Route::group(['middleware'=>['auth','ceklevel:tu,mahasiswa,dosen,kaprogdi']],function(){

// });