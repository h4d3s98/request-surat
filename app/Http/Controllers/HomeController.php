<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){
        $id = auth()->user()->id;
        $table = DB::table('tb_request')
                     ->where('id_user','=',$id)
                     ->get();
        return view('welcome',[
            'title' => 'Request - Surat',
            'id_user'=>$id,
            'datas' => $table
        ]);
    }

    public function request_surat(Request $request){
        $validateData = $request->validate([
            'jenis'         => ['required'],
            'tempat_kp'     => ['required','max:100','min:5'],
            'keterangan'    => ['required','max:100','min:5']
        ]);
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
            'tempat_kp'         => $request->input('tempat_kp'),
            'id_user'           => $id_user,
            'berkas'            => $berkas,
            'keterangan'        => $request->input('keterangan'),
            'status'            => $status,
            'tanggal_update'    => $tanggal_request
        ]);

        if ($query) {
            return back()->with('success','Request Berhasil. Akan segera diproses');
        }else{
            return back()->with('failed','Maaf Request gagal. Coba Lagi');
        }
    }

}
