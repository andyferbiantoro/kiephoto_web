<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pelanggan;
use App\Paket;
use App\Tipe_Paket;
use App\Portofolio;
use App\Pembayaran;
use App\Pemesanan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use File;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
	public function index(){

		$year = Carbon::now()->format('Y');
		$januari = Pemesanan::whereMonth('created_at',1)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$februari = Pemesanan::whereMonth('created_at',2)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$maret = Pemesanan::whereMonth('created_at',3)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$april = Pemesanan::whereMonth('created_at',4)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$mei = Pemesanan::whereMonth('created_at',5)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$juni = Pemesanan::whereMonth('created_at',6)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$juli = Pemesanan::whereMonth('created_at',7)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$agustus = Pemesanan::whereMonth('created_at',8)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$september = Pemesanan::whereMonth('created_at',9)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$oktober = Pemesanan::whereMonth('created_at',10)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$november = Pemesanan::whereMonth('created_at',11)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();
		$desember = Pemesanan::whereMonth('created_at',12)->whereYear('created_at', $year)->where('status_pemesanan','Selesai')->count();

		return view('admin.index',compact('januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'));
	}


	public function admin_kelola_pelanggan(){

		$pelanggan = DB::table('pelanggan')
		->join('users' , 'pelanggan.id_user', '=' , 'users.id')
		->select('pelanggan.*','users.username','users.email')
		->orderBy('pelanggan.id','DESC')
		->get();

		// return $pelanggan;
		return view('admin.kelola_pelanggan.index',compact('pelanggan'));
	}


	public function admin_kelola_pelanggan_delete($id)
	{
		$pelanggan = Pelanggan::findOrFail($id);

		$user = User::where('id', $pelanggan->id_user)->first();
		$user->delete();

		$delete_pelanggan = Pelanggan::findOrFail($id);
		$delete_pelanggan->delete();

		return redirect()->back()->with('success', 'Data Pelanggan Berhasil Dihapus');
	}


	public function admin_kelola_paket(){

		$paket = Paket::all();

		return view('admin.kelola_paket.index',compact('paket'));
	}

	public function admin_kelola_paket_add(Request $request){

		$data_add = new Paket();

		$data_add->nama_paket = $request->input('nama_paket');
		if($request->hasFile('foto_paket')){
			$file = $request->file('foto_paket');
			$filename = $file->getClientOriginalName();
			$file->move('uploads/foto_paket/', $filename);
			$data_add->foto_paket = $filename;


		}else{
			echo "Gagal upload gambar";
		}

		$data_add->save();

		return redirect()->back()->with('success', 'Data Paket Baru Berhasil Ditambahkan');
	}


	public function admin_kelola_paket_update(Request $request, $id)
	{

		$data_update = Paket::where('id', $id)->first();

		$input = [
			'nama_paket' => $request->nama_paket,

		];

		if ($file = $request->file('foto_paket')) {
			if ($data_update->foto_paket) {
				File::delete('uploads/foto_paket/' . $data_update->foto_paket);
			}
			$nama_file = $file->getClientOriginalName();
			$file->move(public_path() . '/uploads/foto_paket/', $nama_file);
			$input['foto_paket'] = $nama_file;
		}

		$data_update->update($input);

		return redirect()->back()->with('success', 'Data Paket Berhasil Diupdate');
	}


	public function admin_kelola_paket_delete($id)
	{
		$paket = Paket::findOrFail($id);

		$tipe_paket = Tipe_Paket::where('id_paket', $id)->get();
		foreach ($tipe_paket as $key => $value) {
			File::delete('uploads/foto_tipe_paket/'.$value->foto_tipe_paket);
			$value->delete();
		}

		$delete_paket = Paket::findOrFail($id);
		File::delete('uploads/foto_paket/'.$delete_paket->foto_paket);
		$delete_paket->delete();

		return redirect()->back()->with('success', 'Data Paket Berhasil Dihapus');
	}



	public function admin_detail_paket($id){

		$detail_paket = Tipe_Paket::where('id_paket', $id)->get();
		//return $detail_paket;

		$paket = Paket::where('id', $id)->first();
		$id_paket = $paket->id;

		//return $id_paket;

		return view('admin.kelola_paket.detail_paket',compact('detail_paket','id_paket'));
	}


	public function admin_detail_paket_add(Request $request){

		$data_add = new Tipe_Paket();

		$data_add->id_paket = $request->input('id_paket');
		$data_add->nama_tipe_paket = $request->input('nama_tipe_paket');
		$data_add->harga_tipe_paket = $request->input('harga_tipe_paket');
		$data_add->deskripsi_tipe_paket = $request->input('deskripsi_tipe_paket');
		$data_add->min_dp = $request->input('min_dp');
		$data_add->jumlah_orang = $request->input('jumlah_orang');
		$data_add->jumlah_pose = $request->input('jumlah_pose');
		$data_add->jumlah_file = $request->input('jumlah_file');

		if($request->hasFile('foto_tipe_paket')){
			$file = $request->file('foto_tipe_paket');
			$filename = $file->getClientOriginalName();
			$file->move('uploads/foto_tipe_paket/', $filename);
			$data_add->foto_tipe_paket = $filename;


		}else{
			echo "Gagal upload gambar";
		}

		//return $data_add;
		$data_add->save();

		return redirect()->back()->with('success', 'Data Tipe Paket Baru Berhasil Ditambahkan');
	}


	public function admin_detail_paket_update(Request $request, $id)
	{

		$data_update = Tipe_Paket::where('id', $id)->first();

		$input = [
			'nama_tipe_paket' => $request->nama_tipe_paket,
			'harga_tipe_paket' => $request->harga_tipe_paket,
			'deskripsi_tipe_paket' => $request->deskripsi_tipe_paket,
			'min_dp' => $request->min_dp,
			'jumlah_orang' => $request->jumlah_orang,
			'jumlah_pose' => $request->jumlah_pose,
			'jumlah_file' => $request->jumlah_file,

		];

		if ($file = $request->file('foto_tipe_paket')) {
			if ($data_update->foto_tipe_paket) {
				File::delete('uploads/foto_tipe_paket/' . $data_update->foto_tipe_paket);
			}
			$nama_file = $file->getClientOriginalName();
			$file->move(public_path() . '/uploads/foto_tipe_paket/', $nama_file);
			$input['foto_tipe_paket'] = $nama_file;
		}

		$data_update->update($input);

		return redirect()->back()->with('success', 'Data Tipe Paket Berhasil Diupdate');
	}


	public function admin_detail_paket_delete($id)
	{
		$delete = Tipe_Paket::findOrFail($id);
		File::delete('uploads/foto_tipe_paket/'.$delete->foto_tipe_paket);
		$delete->delete();

		return redirect()->back()->with('success', 'Data Tipe Paket Berhasil Dihapus');
	}

	//=====================================================================================================================

	public function admin_kelola_portofolio(){

		$portofolio = Portofolio::orderBy('id', "DESC")->get();
		$paket = Paket::orderBy('id', "DESC")->get();

		return view('admin.kelola_portofolio.index', compact('portofolio','paket'));
	}


	public function admin_kelola_portofolio_add(Request $request){

		$data_add = new Portofolio();

		$data_add->id_paket = $request->input('id_paket');
		$data_add->keterangan = $request->input('keterangan');
		

		if($request->hasFile('foto')){
			$file = $request->file('foto');
			$filename = $file->getClientOriginalName();
			$file->move('uploads/foto/', $filename);
			$data_add->foto = $filename;


		}else{
			echo "Gagal upload gambar";
		}

		//return $data_add;
		$data_add->save();

		return redirect()->back()->with('success', 'Data Portofolio Baru Berhasil Ditambahkan');
	}


	public function admin_kelola_portofolio_update(Request $request, $id)
	{

		$data_update = Portofolio::where('id', $id)->first();

		$input = [
			'keterangan' => $request->keterangan,
			
		];

		if ($file = $request->file('foto')) {
			if ($data_update->foto) {
				File::delete('uploads/foto/' . $data_update->foto);
			}
			$nama_file = $file->getClientOriginalName();
			$file->move(public_path() . '/uploads/foto/', $nama_file);
			$input['foto'] = $nama_file;
		}

		$data_update->update($input);

		return redirect()->back()->with('success', 'Data Portofolio Berhasil Diupdate');
	}


	public function admin_kelola_portofolio_delete($id)
	{
		$delete = Portofolio::findOrFail($id);
		File::delete('uploads/foto/'.$delete->foto);
		$delete->delete();

		return redirect()->back()->with('success', 'Data Portofolio Berhasil Dihapus');
	}
//=======================================================================================================================

	public function admin_kelola_pemesanan(){

		$pemesanan = DB::table('pemesanan')
		->join('pelanggan' , 'pemesanan.id_pelanggan', '=' , 'pelanggan.id')
		->join('tipe_paket' , 'pemesanan.id_tipe_paket', '=' , 'tipe_paket.id')
		->select('pemesanan.*','pelanggan.nama_lengkap')
		->orderBy('pemesanan.id','DESC')
		->get();

		return view('admin.kelola_pemesanan.index',compact('pemesanan'));
	}


	public function admin_detail_pemesanan($id){

		$pemesanan = DB::table('pemesanan')
		->join('pelanggan' , 'pemesanan.id_pelanggan', '=' , 'pelanggan.id')
		->join('tipe_paket' , 'pemesanan.id_tipe_paket', '=' , 'tipe_paket.id')
		->join('paket' , 'tipe_paket.id_paket', '=' , 'paket.id')
		->select('pemesanan.*','pelanggan.nama_lengkap','tipe_paket.nama_tipe_paket','tipe_paket.jumlah_orang','tipe_paket.jumlah_pose','tipe_paket.jumlah_file','tipe_paket.harga_tipe_paket','paket.nama_paket')
		->orderBy('pemesanan.id','DESC')
		->get();

		return view('admin.kelola_pemesanan.detail_pemesanan',compact('pemesanan'));
	}

	public function admin_detail_pembayaran($id_pemesanan){

		$pembayaran = DB::table('pembayaran')
		->join('pemesanan' , 'pembayaran.id_pemesanan', '=' , 'pemesanan.id')
		->join('pelanggan' , 'pemesanan.id_pelanggan', '=' , 'pelanggan.id')
		->select('pembayaran.*','pelanggan.nama_lengkap','pemesanan.nominal_dp','pemesanan.total_bayar','pemesanan.jenis_pembayaran')
		->orderBy('pembayaran.id','DESC')
		->get();

		return view('admin.kelola_pemesanan.detail_pembayaran',compact('pembayaran'));
	}

	public function admin_verifikasi_pembayaran($id)
	{
		$status_bayar = Pembayaran::where('id',$id)->first();
		$pem = Pemesanan::where('id', $status_bayar->id_pemesanan)->first();

		$input = [
			'status_pembayaran' => $pem->jenis_pembayaran,
		];
		$status_bayar->update($input);


		$status_pesan = Pemesanan::where('id',$status_bayar->id_pemesanan)->first();

		$input = [
			'status_pemesanan' => $status_pesan->jenis_pembayaran,
		];
		$status_pesan->update($input);
		
		$pembayaran_mail = Pembayaran::where('id',$id)->first();
		$this->received($pembayaran_mail);

		return redirect()->back()->with('success', 'Konfirmasi Pembayaran Berhasil');
	}


	//memberikan notifikasi ke email pelangan setelah melakukan pemesanan
    public function received($pembayaran_mail)
    {
        
        $pembayaran_mail= DB::table('pembayaran')
        ->join('pemesanan', 'pembayaran.id_pemesanan', '=', 'pemesanan.id')
        ->join('pelanggan', 'pemesanan.id_pelanggan', '=', 'pelanggan.id')
        ->join('users', 'pelanggan.id_user', '=', 'users.id')
        ->select('pembayaran.*','users.email','pemesanan.kode_pemesanan','pemesanan.nominal_dp','pemesanan.jenis_pembayaran','pemesanan.sisa_bayar','pemesanan.total_bayar')
        ->where('pembayaran.id', $pembayaran_mail->id)
        ->orderBy('pembayaran.id','DESC')
        ->first();

        

        $this->_sendEmail($pembayaran_mail);

    }

    public function _sendEmail($pembayaran_mail)
    {
        $message = new \App\Mail\PembayaranMail($pembayaran_mail);
        \Mail::to($pembayaran_mail->email)->send($message);
    }



	public function admin_cancel_pembayaran($id)
	{
		$status_bayar = Pembayaran::where('id',$id)->first();

		$input = [
			'status_pembayaran' => 'Cancel',
		];
		$status_bayar->update($input);


		$status_pesan = Pemesanan::where('id',$status_bayar->id_pemesanan)->first();

		$input = [
			'status_pemesanan' => 'Cancel',
		];
		$status_pesan->update($input);
		

		return redirect()->back()->with('success', 'Pembayaran telah ditolak');
	}


	public function admin_lunasi_pembayaran(Request $request,$id)
	{
		$status_bayar = Pemesanan::where('id',$id)->first();

		$input = [
			'sisa_bayar' => $status_bayar->sisa_bayar - $request['sisa_bayar'],
			'jenis_pembayaran' =>'Lunas',
			'status_pemesanan' =>'Lunas',
		];
		$status_bayar->update($input);


		return redirect()->back()->with('success', 'Pelunasan Pembayaran Berhasil');
	}


	public function admin_selesaikan_sesi(Request $request,$id)
	{
		$status_pesan = Pemesanan::where('id',$id)->first();

		$input = [
			'status_pemesanan' =>'Selesai'
		];
		$status_pesan->update($input);

		$status_bayar = Pembayaran::where('id_pemesanan',$id)->first();

		$input = [
			'status_pembayaran' =>'Selesai'
		];
		$status_bayar->update($input);


		$ambil_mail = Pemesanan::where('id',$id)->first();
		$this->received2($ambil_mail);

		return redirect()->back()->with('success', 'Sesi Telah Diselesaikan');
	}


	public function received2($ambil_mail)
    {
        
        $ambil_mail= DB::table('pemesanan')
        ->join('pelanggan', 'pemesanan.id_pelanggan', '=', 'pelanggan.id')
        ->join('users', 'pelanggan.id_user', '=', 'users.id')
        ->select('pemesanan.id','users.email','pelanggan.nama_lengkap')
        ->where('pemesanan.id', $ambil_mail->id)
        ->first();
      ;

        $this->_sendEmail2($ambil_mail);

    }

    public function _sendEmail2($ambil_mail)
    {
        $message = new \App\Mail\NotifDiambilMail($ambil_mail);
        \Mail::to($ambil_mail->email)->send($message);
    }


	public function admin_foto_diambil(Request $request,$id)
	{
		$status_pesan = Pemesanan::where('id',$id)->first();

		$input = [
			'status_pemesanan' =>'Diambil'
		];
		$status_pesan->update($input);

		$status_bayar = Pembayaran::where('id_pemesanan',$id)->first();

		$input = [
			'status_pembayaran' =>'Diambil'
		];
		$status_bayar->update($input);


		return redirect()->back()->with('success', 'Foto Telah Diambil');
	}

//=======================================================================================================================
	public function admin_kelola_laporan_transaksi(Request $request){

		$from = $request->from;
		$to = $request->to;

		if ($from == null && $to == null) {
			$transaksi = DB::table('pembayaran')
			->join('pemesanan' , 'pembayaran.id_pemesanan', '=' , 'pemesanan.id')
			->join('pelanggan' , 'pemesanan.id_pelanggan', '=' , 'pelanggan.id')
			->select('pembayaran.*','pelanggan.nama_lengkap','pemesanan.nominal_dp','pemesanan.total_bayar','pemesanan.status_pemesanan','pemesanan.kode_pemesanan','pemesanan.tanggal_pemesanan','pemesanan.jumlah_orang')
			->orderBy('pembayaran.id','DESC')
			->get();

		}else{
			$transaksi = DB::table('pembayaran')
			->join('pemesanan' , 'pembayaran.id_pemesanan', '=' , 'pemesanan.id')
			->join('pelanggan' , 'pemesanan.id_pelanggan', '=' , 'pelanggan.id')
			->select('pembayaran.*','pelanggan.nama_lengkap','pemesanan.nominal_dp','pemesanan.total_bayar','pemesanan.status_pemesanan','pemesanan.kode_pemesanan','pemesanan.tanggal_pemesanan','pemesanan.jumlah_orang')
			->whereBetween('pemesanan.tanggal_pemesanan', [$from, $to])
			->orderBy('pembayaran.id','DESC')
			->get();
		}


		return view('admin.kelola_transaksi.index',compact('transaksi','from','to'));
	}


//=====================================================================================================================
	public function admin_kelola_pengaturan(){


		return view('admin.pengaturan.index');
	}

//===================================================================================================================
	public function admin_ubah_password(){


		return view('admin.ubah_password.index');
	}


	public function admin_update_password(Request $request)
	{
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

		$password_lama = $request->password_lama;

		$cek_password = User::where('id', Auth::user()->id)->first();

		

			$user = User::where('id', Auth::user()->id)->first();

			$input = [
				'password' => Hash::make($request['password']),

			];

			$user->update($input);

		return redirect()->back()->with('success', 'Update Password Berhasil');
		

	}


}
