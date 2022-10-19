@extends('layouts.app_admin')

@section('title')
Detail Pembayaran
@endsection


@section('content') 


<div class="row match-height">
  <!-- Greetings Card starts -->
  <div class="col-12">
    <div class="card">
      <div class="card-body text-center">
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
      <div class="text-center">
        <h3 class="mb-1 text-primary">DETAIL PEMBAYARAN</h3><br>
        <div class="text-left">
          <a href="{{ route('admin_kelola_pemesanan') }}"><button type="button" class="btn btn-danger btn-sm">
             Kambali
           </button></a><br>
        </div>
        <div class="table-responsive">
          <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Bayar</th>
                <th>Nama Rekening</th>
                <th>Nomor Rekening</th>
                <th>Nama Bank</th>
                <th>Jumlah Bayar</th>
                <th>Jenis Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Opsi</th>

                <th style="display: none;">hidden</th>
              </tr>
            </thead>
            <tbody>
             @php $no=1 @endphp
             @foreach($pembayaran as $data)
             <tr>
              <td>{{$no++}}</td>
              <td>{{$data->nama_lengkap }}</td>
              <td>{{date("j F Y", strtotime($data->tanggal_bayar))}}</td>
              @if($data->metode_pembayaran == 'Transfer')
                  <td>{{$data->nama_rekening }}</td>
                  <td>{{$data->no_rekening }}</td>
                  <td>{{$data->nama_bank }}</td>
              @elseif($data->metode_pembayaran == 'Tunai')
                  <td><b class="text-primary">Pembayaran Tunai</b></td>
                  <td><b class="text-primary">Pembayaran Tunai</b></td>
                  <td><b class="text-primary">Pembayaran Tunai</b></td>
              @endif    
              @if($data->jenis_pembayaran == 'DP')
              <td>Rp. <?=number_format($data->nominal_dp, 0, ".", ".")?>,00</td>
              @elseif($data->jenis_pembayaran == 'Lunas')
              <td>Rp. <?=number_format($data->total_bayar, 0, ".", ".")?>,00</td>
              @endif
              <td>{{$data->jenis_pembayaran }}</td>
              @if($data->metode_pembayaran == 'Transfer')
                <td>
                  <img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('uploads/foto_bukti_bayar/'.$data->foto_bukti_bayar)}}"  data-toggle="modal" data-target="#myModal"></img>
                </td>
                @elseif($data->metode_pembayaran == 'Tunai')
                <td>
                  <b class="text-primary">Pembayaran Tunai</b>
                </td>
              @endif


              <td>
                @if($data->status_pembayaran == 'Menunggu Konfirmasi')
                <a href="#" data-toggle="modal" onclick="VerifikasiData({{$data->id}})" data-target="#VerifikasiModal">
                 <button class="btn btn-warning btn-sm"  title="Verifikasi">Verifikasi</button>
               </a><br><br>

               <a href="#" data-toggle="modal" onclick="CancelData({{$data->id}})" data-target="#CancelModal">
                 <button class="btn btn-danger btn-sm"  title="Cancel">Cancel</button>
               </a>
               @elseif($data->status_pembayaran == 'DP')
               <b class="text-success">Pembayaran telah dikonfirmasi</b>
               @elseif($data->status_pembayaran == 'Lunas')
               <b class="text-success">Pembayaran telah dikonfirmasi</b>
               @elseif($data->status_pembayaran == 'Cancel')
               <b class="text-danger">Pembayaran telah Ditolak</b>
               @elseif($data->status_pembayaran == 'Selesai')
               <b class="text-success">Sesi Pemotretan Telah Selesai</b>
               @elseif($data->status_pembayaran == 'Diambil')
               <b class="text-primary">Foto Telah Diambil Oleh Pelanggan</b>
               @endif
             </td>

             <td style="display: none;">{{$data->id}}</td>

           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
   </div>
 </div>
</div>
</div>
</div>




<!-- Modal konfirmasi Verifikasi -->
<div id="VerifikasiModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <form action="" id="VerifikasiForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Verifikasi Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      {{ csrf_field() }}
      {{ method_field('POST') }}
      <p>Apakah anda yakin ingin verifikasi pembayaran ini ?</p>
      <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
      <button type="submit" name="" class="btn btn-success float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Verifikasi</button>
  </div>
</div>
</form>
</div>
</div> 



<!-- Modal konfirmasi Cancel -->
<div id="CancelModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <form action="" id="CancelForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cancel Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      {{ csrf_field() }}
      {{ method_field('POST') }}
      <p>Apakah anda yakin ingin cancel pembayaran ini ?</p>
      <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
      <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmitCancel()">Cancel</button>
  </div>
</div>
</form>
</div>
</div> 






<!-- show Foto -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="img01" style="width: 450px; height: auto;" >
      </div>
    </div>
  </div>
</div>
@endsection  

@section('scripts')
<script type="text/javascript">
  function VerifikasiData(id) {
    var id = id;
    var url = '{{route("admin_verifikasi_pembayaran", ":id") }}';
    url = url.replace(':id', id);
    $("#VerifikasiForm").attr('action', url);
  }

  function formSubmit() {
    $("#VerifikasiForm").submit();
  }
</script>


<script type="text/javascript">
  function CancelData(id) {
    var id = id;
    var url = '{{route("admin_cancel_pembayaran", ":id") }}';
    url = url.replace(':id', id);
    $("#CancelForm").attr('action', url);
  }

  function formSubmitCancel() {
    $("#CancelForm").submit();
  }
</script>




@endsection                  
