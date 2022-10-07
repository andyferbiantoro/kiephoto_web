<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use App\Paket;
use App\Tipe_Paket;
use App\Portofolio;
use App\User;
use App\Pemesanan;
use App\Pembayaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use File;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{


	public function dashboard(){

		$paket = Paket::orderby('id','DESC')->get();

		return view('pelanggan.dashboard',compact('paket'));
	}


	public function pelanggan_pemesanan($id){

		$tipe_paket = Tipe_Paket::where('id', $id)->get();

		$tipe_paket = DB::table('tipe_paket')
		->join('paket' , 'tipe_paket.id_paket', '=' , 'paket.id')
		->select('tipe_paket.*','paket.nama_paket')
		->get();
		
		$pelanggan = Pelanggan::where('id_user', Auth::user()->id)->first();
		$id_pelanggan = $pelanggan->id;
		$nama_pelanggan = $pelanggan->nama_lengkap;
		$no_telp = $pelanggan->no_telp;


		return view('pelanggan.pemesanan.index',compact('tipe_paket', 'id_pelanggan','nama_pelanggan','no_telp'));
	}


	public function pelanggan_pemesanan_add(Request $request){

		//$kode = Str::random(5);  
		$kode = mt_rand(1000, 9999);

		$data = ([
			'id_pelanggan' => $request['id_pelanggan'],
			'id_tipe_paket' => $request['id_tipe_paket'],
			'kode_pemesanan' => 'RF-'.$kode,
			'tanggal_pemesanan' => $request['tanggal_pemesanan'],
			'status_pemesanan' => $request['status_pemesanan']="Pending",
			'jumlah_orang' => $request['jumlah_orang'],
			'jumlah_pose_pemesanan' => $request['jumlah_pose_pemesanan'],
			'jumlah_file_pemesanan' => $request['jumlah_file_pemesanan'],
			'metode_pembayaran' => $request['metode_pembayaran'],
			'jenis_pembayaran' => $request['jenis_pembayaran'],
			'nominal_dp' => $request['nominal_dp'],
			'total_bayar' => $request['total_bayar'],

		]);

		// return $data;

		$lastid = Pemesanan::create($data)->id;

		$cek_pemesanan = Pemesanan::where('id', $lastid)->first();

		if ($cek_pemesanan->jenis_pembayaran == 'DP') {
    		# code...
			$sisa_bayar = $cek_pemesanan->total_bayar - $cek_pemesanan->nominal_dp;
			$input = [
				'sisa_bayar' => $sisa_bayar,
			];

			$cek_pemesanan->update($input);
		}

		$pemesanan_mail = Pemesanan::where('id', $lastid)->first();
		$this->received($pemesanan_mail);

		return redirect('/pelanggan_riwayat_pemesanan')->with('success', 'Pemesanan Anda Sedang Diproses');
	}



	//memberikan notifikasi ke email pelangan setelah melakukan pemesanan
    public function received($pemesanan_mail)
    {
        
        $pemesanan_mail= DB::table('pemesanan')
        ->join('pelanggan', 'pemesanan.id_pelanggan', '=', 'pelanggan.id')
        ->join('tipe_paket', 'pemesanan.id_tipe_paket', '=', 'tipe_paket.id')
        ->join('paket', 'tipe_paket.id_paket', '=', 'paket.id')
        ->join('users', 'pelanggan.id_user', '=', 'users.id')
        ->select('pemesanan.*','users.email','pelanggan.nama_lengkap','paket.nama_paket','tipe_paket.nama_tipe_paket','tipe_paket.min_dp')
        ->where('pemesanan.id', $pemesanan_mail->id)
        ->orderBy('pemesanan.id','DESC')
        ->first();

        

        $this->_sendEmail($pemesanan_mail);

    }

    public function _sendEmail($pemesanan_mail)
    {
        $message = new \App\Mail\PemesananMail($pemesanan_mail);
        \Mail::to($pemesanan_mail->email)->send($message);
    }



	public function pelanggan_riwayat_pemesanan(){

		$pelanggan = Pelanggan::where('id_user', Auth::user()->id)->first();

		//$pemesanan = Pemesanan::where('id_pelanggan', $pelanggan->id)->orderby('id','DESC')->get();
		$pemesanan = DB::table('pemesanan')
		->join('tipe_paket' , 'pemesanan.id_tipe_paket', '=' , 'tipe_paket.id')
		->join('paket' , 'tipe_paket.id_paket', '=' , 'paket.id')
		->select('pemesanan.*','paket.nama_paket','tipe_paket.nama_tipe_paket')
		->where('id_pelanggan', $pelanggan->id)
		->orderby('id','DESC')
		->get();
		// return $pemesanan;

		return view('pelanggan.pemesanan.riwayat_pemesanan',compact('pemesanan'));
	}






	public function pelanggan_pembayaran($id_pemesanan){

		$pemesanan = Pemesanan::where('id', $id_pemesanan)->get();
		//return $pemesanan;


		return view('pelanggan.pemesanan.konfirmasi_pembayaran',compact('pemesanan'));
	}


	public function pelanggan_pembayaran_add(Request $request){

		
		$data_add = new Pembayaran();

		$data_add->id_pemesanan = $request->input('id_pemesanan');
		$data_add->tanggal_bayar = $request->input('tanggal_bayar');
		$data_add->nama_rekening = $request->input('nama_rekening');
		$data_add->no_rekening = $request->input('no_rekening');
		$data_add->nama_bank = $request->input('nama_bank');
		$data_add->status_pembayaran = 'Menunggu Konfirmasi';


		if($request->hasFile('foto_bukti_bayar')){
			$file = $request->file('foto_bukti_bayar');
			$filename = $file->getClientOriginalName();
			$file->move('uploads/foto_bukti_bayar/', $filename);
			$data_add->foto_bukti_bayar = $filename;

		}else{
			echo "Gagal upload gambar";
		}

		$data_add->save();

		$status_update = Pemesanan::where('id', $request->input('id_pemesanan'))->first();

		$input = [
			'status_pemesanan' => 'Menunggu Konfirmasi',

		];

		$status_update->update($input);

		return redirect('/pelanggan_riwayat_pemesanan')->with('success', 'Pembayaran Anda Sedang Diproses');
	}

	//==========================================================================================================





	public function paket(){
		$paket = Paket::orderby('id','DESC')->get();

		return view('pelanggan.paket.index',compact('paket'));
	}

	public function tipe_paket($id_paket){
		$tipe_paket = Tipe_Paket::where('id_paket', $id_paket)->orderby('id','DESC')->get();
		

		return view('pelanggan.paket.tipe_paket',compact('tipe_paket'));
	}

	public function tentang(){
		$Portofolio = Portofolio::orderby('id','DESC')->get();

		return view('pelanggan.tentang.index',compact('Portofolio'));
	}

	public function panduan(){


		return view('pelanggan.panduan.index');
	}


	//====================================================================================================
	public function pelanggan_profil(){

		// $pelanggan = Pelanggan::where('id_user', Auth::user()->id )->get();
		$pelanggan = DB::table('pelanggan')
		->join('users' , 'pelanggan.id_user', '=' , 'users.id')
		->select('pelanggan.*','users.email')
		->where('pelanggan.id_user', Auth::user()->id)
		->get();
		return view('pelanggan.profil.index',compact('pelanggan'));
	}

	public function pelanggan_profil_edit($id){

		// $pelanggan = Pelanggan::where('id_user', Auth::user()->id )->get();
		$pelanggan = DB::table('pelanggan')
		->join('users' , 'pelanggan.id_user', '=' , 'users.id')
		->select('pelanggan.*','users.email')
		->where('pelanggan.id', $id)
		->get();

		//return $pelanggan;
		return view('pelanggan.profil.edit',compact('pelanggan'));
	}


	public function pelanggan_profil_update(Request $request)
	{
		

		// $password_lama = $request->password_lama;

		// $cek_password = User::where('id', Auth::user()->id)->first();

			$user = User::where('id', Auth::user()->id)->first();

			$input = [
				'password' => Hash::make($request['password']),

			];

			$user->update($input);


			$pelanggan = Pelanggan::where('id_user', Auth::user()->id)->first();

			$input = [
				'nama_lengkap' => $request['nama_lengkap'],
				'no_telp' => $request['no_telp'],
				'alamat' => $request['alamat'],

			];

			$pelanggan->update($input);

		return redirect()->back()->with('success', 'Update Profil Berhasil');
		

	}
}
