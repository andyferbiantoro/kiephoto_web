<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{


	public function dashboard(){


		return view('pelanggan.dashboard');
	}


	public function pelanggan_pemesanan(){

		
		return view('pelanggan.pelanggan_pemesanan');
	}
}
