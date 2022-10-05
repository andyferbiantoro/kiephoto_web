<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    //
    protected $table = 'pelanggan';
	protected $fillable = [
		'nama_lengkap','no_telp','alamat','id_user'
	];
}
