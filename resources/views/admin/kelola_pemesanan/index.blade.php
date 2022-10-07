@extends('layouts.app_admin')

@section('title')
Kelola Pemesanan
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
                <h3 class="mb-1 text-primary">KELOLA PEMESANAN</h3><br>
                
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Pemesanan</th>
                          <th>Nama</th>
                          <th>Tanggal Pemesanan</th>
                          <th>Jumlah Orang</th>
                          <th>Total Bayar</th>
                          <th>Status</th>
                          <th>Opsi</th>

                          <th style="display: none;">hidden</th>
                      </tr>
                  </thead>
                  <tbody>
                   @php $no=1 @endphp
                   @foreach($pemesanan as $data)
                   <tr>
                      <td>{{$no++}}</td>
                      <td>{{$data->kode_pemesanan }}</td>
                      <td>{{$data->nama_lengkap }}</td>
                      <td>{{date("j F Y", strtotime($data->tanggal_pemesanan))}}</td>
                      <td>{{$data->jumlah_orang }} Orang</td>
                      <td>Rp. <?=number_format($data->total_bayar, 0, ".", ".")?>,00</td>
                      <td>{{$data->status_pemesanan }}</td>
                      

                      <td>
                       <a href="{{ route('admin_detail_pemesanan',$data->id) }}"><button class="btn btn-success btn-sm ">Detail Pemesanan</button></a> <br><br>

                       <a href="{{ route('admin_detail_pembayaran',$data->id) }}"><button class="btn btn-primary btn-sm ">Detail Pembayaran</button></a> 

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
