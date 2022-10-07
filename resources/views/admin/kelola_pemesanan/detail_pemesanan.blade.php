@extends('layouts.app_admin')

@section('title')
Detail Pemesanan
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
      @foreach($pemesanan as $data)
      <div class="text-center"><br><br>
        <h3 class="mb-1 text-primary">DETAIL PEMESANAN</h3><br>
        <div class="col-lg-8">
          <div class="table-responsive text-left">
            <table class="table table-striped">
              <tr>
                <th>Kode Pemesanan</th>
                <th>:</th>
                <td>{{$data->kode_pemesanan}}</td>
              </tr> 

              <tr>
                <th>Paket / Tipe Paket</th>
                <th>:</th>
                <td>{{$data->nama_paket}} / {{$data->nama_tipe_paket}}</td>
              </tr> 

              <tr>
                <th>Jumlah Orang</th>
                <th>:</th>
                <td>{{$data->jumlah_orang}} Orang</td>
              </tr>

              <tr>
                <th>Jumlah Pose</th>
                <th>:</th>
                <td>{{$data->jumlah_pose}} Pose</td>
              </tr> 

              <tr>
                <th>Jumlah File</th>
                <th>:</th>
                <td>{{$data->jumlah_file}} File</td>
              </tr>

              <tr>
                <th>Harga Paket</th>
                <th>:</th>
                <td>Rp. <?=number_format($data->harga_tipe_paket, 0, ".", ".")?>,00</td>
              </tr>

            </table><br><br><hr>

            <table class="table table-striped">
              <tr>
                <th>Pembayaran DP</th>
                <th>:</th>
                <td>Rp. <?=number_format($data->nominal_dp, 0, ".", ".")?>,00</td>
              </tr> 

              <tr>
                <th class="text-primary">Total Bayar</th>
                <th class="text-primary">:</th>
                <td class="text-primary">Rp. <?=number_format($data->total_bayar, 0, ".", ".")?>,00</td>
              </tr> 

              <tr>
                <th class="text-danger">Tagihan</th>
                <th class="text-danger">:</th>
                <td class="text-danger">Rp. <?=number_format($data->sisa_bayar, 0, ".", ".")?>,00</td>
              </tr> 
            </table><br>

             @if($data->jenis_pembayaran == 'DP' && $data->status_pemesanan == 'Menunggu Konfirmasi')
              <b class="text-danger">Pembayaran belum dikonfirmasi, silahkan periksa detail pembayaran</b><br>
            @endif 

            @if($data->jenis_pembayaran == 'DP' && $data->status_pemesanan == 'DP')
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalLunas">
                Lunasi
              </button><br>
            @endif 

            @if($data->jenis_pembayaran == 'Lunas' && $data->status_pemesanan == 'Lunas' )
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalSelesai">
                Selesaikan Sesi
              </button><br>
            @endif

            @if($data->status_pemesanan == 'Selesai' )
              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ModalDiambil">
               Diambil
              </button><br>
            @endif  

            @if($data->status_pemesanan == 'Diambil' )
              <b class="text-primary">Sesi Selesai dan Foto Telah Diambil Oleh Pelanggan</b><br>
            @endif  
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</div>
</div>




<!-- Modal pelunasan -->
<div class="modal fade" id="ModalLunas" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Lunasi Pembayaran ini</h5>
    </div>
    @foreach($pemesanan as $lunas)
    <div class="modal-body">
     <form method="post" action="{{route('admin_lunasi_pembayaran', $lunas->id )}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="sisa_bayar">Sisa Tagihan</label>
            <input type="text" class="form-control" id="sisa_bayar" name="sisa_bayar"  readonly="" required="" value="{{$lunas->sisa_bayar}}"></input>
        </div>

    </div>
    <div class="modal-footer">
      <button class="btn btn-primary" type="Submit">Lunasi</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

  </div>
</form>
</div>
@endforeach
</div>
</div>



<!-- Modal Selesaikan sesi -->
<div class="modal fade" id="ModalSelesai" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Selesaikan Sesi ini</h5>
    </div>
    @foreach($pemesanan as $lunas)
    <div class="modal-body">
     <form method="post" action="{{route('admin_selesaikan_sesi', $lunas->id )}}" enctype="multipart/form-data">

        {{csrf_field()}}

    </div>
    <div class="modal-footer">
      <button class="btn btn-primary" type="Submit">Selesaikan</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

  </div>
</form>
</div>
@endforeach
</div>
</div>


<!-- Modal Ambil Foto -->
<div class="modal fade" id="ModalDiambil" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Konfirmasi Foto Sudah Diambil</h5>
    </div>
    @foreach($pemesanan as $lunas)
    <div class="modal-body">
     <form method="post" action="{{route('admin_foto_diambil', $lunas->id )}}" enctype="multipart/form-data">

        {{csrf_field()}}

    </div>
    <div class="modal-footer">
      <button class="btn btn-warning" type="Submit">Diambil</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

  </div>
</form>
</div>
@endforeach
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
  function deleteData(id) {
    var id = id;
    var url = '{{route("admin_kelola_paket_delete", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }
</script>


<script>
  $(document).ready(function() {
    var table = $('#dataTable').DataTable();
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }
      var data = table.row($tr).data();
      console.log(data);
      $('#nama_paket_update').val(data[1]);
      $('#updateInformasiform').attr('action','admin_kelola_paket_update/'+ data[4]);
      $('#updateInformasi').modal('show');
    });
  });
</script>


@endsection                  
