<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pelanggan;
use App\Paket;
use App\Tipe_Paket;
use Auth;
use File;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
	public function index(){


		return view('admin.index');
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
		$delete = CalonPengantin::findOrFail($id);
		$delete->delete();

		return redirect('/calon_pengantin')->with('success', 'Data calon pengantin Berhasil Dihapus');
	}



	public function admin_detail_paket($id){

		$detail_paket = Tipe_Paket::where('id_paket', $id)->get();
		//return $detail_paket;
		return view('admin.kelola_paket.detail_paket',compact('detail_paket'));
	}

	//=====================================================================================================================

	public function admin_kelola_portofolio(){


		return view('admin.kelola_portofolio.index');
	}


	public function admin_kelola_pemesanan(){


		return view('admin.kelola_pemesanan.index');
	}


	public function admin_kelola_laporan_transaksi(){


		return view('admin.kelola_transaksi.index');
	}

	public function admin_kelola_pengaturan(){


		return view('admin.pengaturan.index');
	}
}
