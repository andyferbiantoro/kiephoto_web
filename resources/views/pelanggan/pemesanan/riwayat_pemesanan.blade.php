@extends('layouts.app')

@section('title')
Riwayat Pemesanan
@endsection


@section('content')




<div class="row match-height">


   <div class="col-12">
    <div class="card ecommerce-card">
        <div class="item-img text-center"><br>
            @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
                @endif
            <h3 class="item-price text-center text-primary"><b>RIWAYAT PEMESANAN</b></h3><br>

        </div>
        <div class="card-header flex-column align-items-start pb-0">
            <div class="item-wrapper">
                <div class="text-center">

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="item-wrapper">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Pemesanan</th>
                          <th>Tanggal Pemesanan</th>
                          <th>Paket $ Tipe Paket</th>
                          <th>Jenis Pembayaran</th>
                          <th>Jumlah Bayar</th>
                          <th>Status</th>
                          <th>Opsi</th>
                          
                      </tr>
                  </thead>
                  <tbody>
                     @php $no=1 @endphp
                     @foreach($pemesanan as $data)
                     <tr>
                      <td>{{$no++}}</td>
                      <td>{{$data->kode_pemesanan }}</td>
                      <td>{{date("j F Y", strtotime($data->tanggal_pemesanan))}}</td>
                      <td>{{$data->nama_paket }} & {{$data->nama_tipe_paket }}</td>
                      <td>{{$data->jenis_pembayaran }}</td>
                      @if($data->jenis_pembayaran == 'Lunas')
                      <td>Rp. <?=number_format($data->total_bayar, 0, ".", ".")?>,00</td>
                      @elseif($data->jenis_pembayaran == 'DP') 
                      <td>Rp. <?=number_format($data->nominal_dp, 0, ".", ".")?>,00</td>
                      @endif
                      <td>{{$data->status_pemesanan }}</td>

                      @if($data->metode_pembayaran == 'Transfer' && ($data->status_pemesanan == 'Pending'))
                      <td>
                         <a href="{{ route('pelanggan_pembayaran',$data->id) }}"><button class="btn btn-primary btn-sm ">Konfirmasi Pembayaran</button></a> 
                     </td>

                     @elseif($data->metode_pembayaran == 'Tunai')
                     <td>
                         <b class="text-primary">Pembayaran Tunai</b> 
                     </td>

                     @elseif($data->metode_pembayaran == 'Transfer' && $data->status_pemesanan == 'Menunggu Konfirmasi')
                     <td>
                         <b class="text-primary">Konfirmasi pembayaran berhasil, silahkan tunggu verifikasi dari admin</b> 
                     </td>

                     @elseif($data->metode_pembayaran == 'Transfer' && $data->status_pemesanan == 'Cancel')
                     <td>
                         <b class="text-danger">Pembayaran Anda ditolak oleh admin, mohon periksa kembali bukti pembayaran</b> 
                     </td>

                      @elseif($data->metode_pembayaran == 'Transfer' && $data->status_pemesanan == 'DP' || $data->status_pemesanan == 'Lunas')
                     <td>
                         <b class="text-success">Pembayaran Anda Diverifikasi oleh admin</b> 
                     </td>

                     @elseif($data->metode_pembayaran == 'Transfer' && $data->status_pemesanan == 'Selesai')
                     <td>
                         <b class="text-primary">Sesi pemotretan anda telah selsai, silahkan ambil foto anda</b> 
                     </td>

                     @elseif($data->metode_pembayaran == 'Transfer' && $data->status_pemesanan == 'Diambil')
                     <td>
                         <b class="text-primary">Foto telah diambil, Terimakasih</b> 
                     </td>
                     @endif
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>

 </div>   
</div>
</div>
</div>




<!-- Orders Chart Card ends -->
</div>






@endsection