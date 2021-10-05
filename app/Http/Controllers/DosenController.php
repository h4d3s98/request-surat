<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    //
    public function index(){
        $id = auth()->user()->id;
        $table = DB::table('tb_request')
                     ->where('id_user','=',$id)
                     ->get();
        return view('welcome-dosen',[
            'title' => 'Request - Surat Dosen',
            'id_user'=>$id,
            'datas' => $table
        ]);
    }

    public function request_dosen(Request $request){
        $request->validate([
            'jenis'         => ['required'],
            'keterangan'    => ['required','max:255','min:10']
        ]);
        $tempat_kp = "None";
        $timezone = new DateTimeZone('Asia/Jakarta');
        $date = new DateTime();
        $date->setTimeZone($timezone);
        $tanggal_request = $date->format('Y-m-d H:i:s');
        $berkas = "None";
        $status = 1;
        $id_user = $request->input('id_user');
        $query = DB::table('tb_request')->insert([
            'jenis_surat'       => $request->input('jenis'),
            'tanggal_request'   => $tanggal_request,
            'tempat_kp'         => $tempat_kp,
            'id_user'           => $id_user,
            'berkas'            => $berkas,
            'keterangan'        => $request->input('keterangan'),
            'status'            => $status,
            'tanggal_update'    => $tanggal_request
        ]);
        if ($query) {
            return back()->with('success'.'Request Surat berhasil.');
        } else {
            return back()->with('failed','Request Gagal, coba lagi');
        }
        
    }

    public function profile(){
        $id_user = auth()->user()->id;
        $datas = DB::table('users')
                ->where('id','=',$id_user)
                ->get();
        return view('account-dosen',[
            'title' => "Account Profile",
            'id_user' => $id_user,
            'datas' => $datas
        ]);
    }

    public function akun_dosen(Request $request){
        $validateData = $request->validate([
            'nama'          =>['required','max:100','min:5'],
            'username'      =>['required','max:20','min:6'],
            'email'         =>['required','email'],
            'nim'           =>['required','max:9','min:9'],
            'new_password'  =>['required','max:12','min:6'],
            'progdi'        =>['required']
        ]);
        $remember_token = Str::random(60);
        $timezone = new DateTimeZone('Asia/Jakarta');
        $date = new DateTime();
        $date->setTimeZone($timezone);
        $tanggal_request = $date->format('Y-m-d H:i:s');
        $id_user = $request->input('id_user');
        $new_password = bcrypt($request->input('new_password'));
        $query = DB::table('users')
                     ->where('id','=',$id_user)
                     ->update([
                         'name'             => $request->input('nama'),
                         'username'         => $request->input('username'),
                         'nim'              => $request->input('nim'),
                         'email'            => $request->input('email'),
                         'password'         => $new_password,
                         'remember_token'   => $remember_token,
                         'updated_at'       => $tanggal_request
                     ]);
        if ($query) {
            return back()->with('success','Update Data berhasil');
        }else{
            return back()->with('failed','Update Data gagal. Coba lagi');
        }
    }
}
