<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaprogdiController extends Controller
{
    //
    public function index(){
        $datas = DB::table('tb_request')
                 ->join('users','tb_request.id_user','=','users.id')
                 ->where('users.level','=','mahasiswa')
                 ->where('tb_request.status','=','3')
                 ->get();
        return view('welcome-kaprogdi',[
            'title' => 'Dashobard - Kaprogdi',
            'datas' => $datas
       ]);
    }

    public function rumah_dosen(){
        $datas = DB::table('tb_request')
                 ->join('users','tb_request.id_user','=','users.id')
                 ->where('tb_request.status','=','3')
                 ->where('users.level','=','dosen')
                 ->get();
        return view('welcome-kaprogdi',[
            'title' => 'Dashobard - Kaprogdi',
            'datas' => $datas
       ]);
    }

    public function profile_kaprogdi(){
        $id_user = auth()->user()->id;
        $datas = DB::table('users')
                ->where('id','=',$id_user)
                ->get();
        return view('account-kaprogdi',[
            'title' => "Account Profile",
            'id_user' => $id_user,
            'datas' => $datas
        ]);
        
    }

    public function akun_kaprogdi(Request $request){
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

    public function upload_kaprogdi(Request $request){
        $request->validate([
            'berkas' => ['required','file','mimes:pdf','max:2048']
        ]);

        $fileName = time()."-".$request->file('berkas')->getClientOriginalName();
        $request->file('berkas')->move(public_path('file/'),$fileName);
        $query = DB::table('tb_request')
                ->where('id_user','=',$request->input('id_user'))
                ->update([
            'status' => $request->input('status'),
            'berkas' => $fileName
        ]);

        if ($query) {
            return back()->with('success','Berhasil Mengunggah Berkas');
        } else {
            return back()->with('failed','Maaf gagal Upload Berkas');
        }
        
    }

    public function download(Request $request, $file_name){
        $file = public_path('file/'.$file_name);
        return response()->download($file);
    }
}
