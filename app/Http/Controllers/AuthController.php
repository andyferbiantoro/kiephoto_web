<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Pelanggan;

class AuthController extends Controller
{
    //

	public function login()
	{
		return view('auth.login');
	}


	public function proses_login(Request $request){
        //remember
        $ingat = $request->remember ? true : false; //jika di ceklik true jika tidak gfalse
        //akan ingat selama 5 tahun jika tidak logout

        if(auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $ingat)){
            //auth->user() untuk memanggil data user yang sudah login
        	
        	if(auth()->user()->role == "admin"){
        		return redirect()->route('admin_index')->with('success', 'Anda Berhasil Login');
        	}else if(auth()->user()->role == "pelanggan"){
        		return redirect()->route('pelanggan_pemesanan')->with('success', 'Anda Berhasil Login');
        	}
        }else {
            return redirect()->back()->with('error', 'Email / Password anda salah'); //route itu isinya name dari route di web.php
        }

    }

    public function register()
    {
    	return view('auth.register');
    }

    public function proses_register (Request $request){
    	$messages = [
    		'required' => ':attribute wajib diisi',
    		'min' => ':attribute harus diisi minimal :min karakter',
    		'max' => ':attribute harus diisi maksimal :max karakter',
    		'same' => ':attribute harus sama dengan konfirmasi password',
    	];

            //validasi
    	$this->validate($request, [
            //pasword validasinya repassword
    		'password' => 'min:5|required_with:repassword|same:repassword',
    		'repassword' => 'min:5'
    	], $messages);

    	$cekemail = User::where('email', $request->email)->where('role','pelanggan')->first();

    	if ($cekemail) {
    		return redirect()->back()->with('error', 'Email Sudah Digunakan');
    	}else{

    		$data = ([
    			'username' => $request['username'],
    			'email' => $request['email'],
    			'role' => $request['role']="pelanggan",
    			'password' => Hash::make($request['password']),
    			
    		]);

    		$lastid = User::create($data)->id; 

    		
    		$data_add = new Pelanggan();

    		$data_add->nama_lengkap = $request->input('nama_lengkap');
    		$data_add->no_telp = $request->input('no_telp');
    		$data_add->alamat = $request->input('alamat');
    		$data_add->id_user = $lastid;

    		$data_add->save();

    		

    		return redirect('/login')->with('success', 'Anda Berhasil Register, Silakan Login');
    	}       
    }


    public function logout(){

        auth()->logout(); //logout
        
        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
        
    }
}
