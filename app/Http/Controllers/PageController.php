<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //

    public function index(){
        return view('login');
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('username','password'))){
        if (auth()->user()->level == 'mahasiswa') {
            return redirect('/home');
        } else if(auth()->user()->level == 'dosen') {
            return redirect('/dashboard');
        }else if(auth()->user()->level == 'kaprogdi'){
            return redirect('/rumah');
        }else if(auth()->user()->level == 'tu'){
            return redirect('/base');
        }
        
            //    return redirect('/home');
        }

        return view('login');
    }

    public function register(){
        return view('register');
    }
    public function reg(Request $request){
        $validateData = $request->validate([
            'nama'      => ['required','max:225'],
            'nim'       => ['required','min:9','max:9'],
            'username'  => ['required','max:20','min:6'],
            'email'     => ['required','email'],
            'password'  => ['required','max:12','min:6'],
            'progdi'    => ['required'],
            'status'    => ['required']
        ]);
        $new_password = bcrypt($request->input('password'));
        $token = Str::random(60);
        $query = DB::table('users')->insert([
            'name'          => $request->input('nama'),
            'username'      => $request->input('username'),
            'nim'           => $request->input('nim'),
            'progdi'        => $request->input('progdi'),
            'level'         => $request->input('status'),
            'email'         => $request->input('email'),
            'password'      => $new_password,
            'remember_token'=> $token,
            'updated_at'     => date("Y/m/d h:i:s"),
            'created_at'     => date("Y/m/d h:i:s")

        ]);
        
        if ($query) {
            return redirect('/')->with('success','Pendaftaran berhasil. Silahkan login');
        } else {
            return redirect('/')->with('failed','Pendaftaran gagal. Silahkan coba lagi');
        }
        
        
        // return view('register');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
