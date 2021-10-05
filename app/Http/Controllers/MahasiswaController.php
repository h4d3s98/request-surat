<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    //
    public function index(){
        $id_user = auth()->user()->id;
        $datas = DB::table('users')
                ->where('id','=',$id_user)
                ->get();
        return view('account',[
            'title' => "Account Profile",
            'id_user' => $id_user,
            'datas' => $datas
        ]);
    }

    public function akun(Request $request){
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
