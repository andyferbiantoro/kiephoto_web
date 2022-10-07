<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div align="left">
	Kode Pemesanan : {{$pembayaran_mail->kode_pemesanan}} <br>
	Tanggal Pembayaran : {{date("j F Y", strtotime($pembayaran_mail->tanggal_bayar))}} <br>
	
	@if($pembayaran_mail->jenis_pembayaran == 'DP')
	Jumlah Bayar : Rp. <?=number_format($pembayaran_mail->nominal_dp, 0, ".", ".")?>,00 <br>
	@elseif($pembayaran_mail->jenis_pembayaran == 'Lunas')
	Jumlah Bayar : Rp. <?=number_format($pembayaran_mail->total_bayar, 0, ".", ".")?>,00 <br>
	@endif	

	Status Pembayaran : {{$pembayaran_mail->status_pembayaran}} <br>
	Jenis Pembayaran : {{$pembayaran_mail->jenis_pembayaran}} <br>
	Total Bayar : Rp. <?=number_format($pembayaran_mail->total_bayar, 0, ".", ".")?>,00 <br>
	Sisa Tagihan : Rp. <?=number_format($pembayaran_mail->sisa_bayar, 0, ".", ".")?>,00 <br>
</div>
</body>
</html>