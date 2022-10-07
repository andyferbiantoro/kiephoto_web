@extends('layouts.app_admin')

@section('title')
Detail Paket
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
                    <h3 class="mb-1">DETAIL PAKET FOTO</h3><br>
                    <div class="text-left">    
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
                            Tambah Tipe Paket
                        </button><br><hr>  
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped" style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Tipe</th>
                              <th>Harga</th>
                              <th>Deskripsi</th>
                              <th>Foto Tipe Paket</th>
                              <th>Minimal DP</th>
                              <th>Opsi</th>
                              <th style="display: none;">hidden jumlah orang</th>
                              <th style="display: none;">hidden jumlah pose</th>
                              <th style="display: none;">hidden jumlah file</th>
                              <th style="display: none;">hidden</th>
                          </tr>
                      </thead>
                      <tbody>
                         @php $no=1 @endphp
                         @foreach($detail_paket as $data)
                         <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->nama_tipe_paket }}</td>
                          <td>{{$data->harga_tipe_paket }}</td>
                          <td>{{$data->deskripsi_tipe_paket }}</td>
                          <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('uploads/foto_tipe_paket/'.$data->foto_tipe_paket)}}"  data-toggle="modal" data-target="#myModal"></img></td>
                          <td>{{$data->min_dp }}</td>
                          <td>
                            <button class="btn btn-warning btn-sm edit" title="Edit">Edit</button>

                            <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                              <button class="btn btn-danger btn-sm"  title="Hapus">Hapus</button>
                            </a>

                          </td>
                          <td style="display: none;">{{$data->jumlah_orang}}</td>
                          <td style="display: none;">{{$data->jumlah_pose}}</td>    
                          <td style="display: none;">{{$data->jumlah_file}}</td>

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





<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Paket Foto</h5>
    </div>
    <div class="modal-body">
     <form method="post" action="{{route('admin_detail_paket_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="nama_tipe_paket">Nama Tipe Paket</label>
            <input type="text" class="form-control" id="nama_tipe_paket" name="nama_tipe_paket"  required=""></input>
        </div>

         <div class="form-group">
            <label for="harga_tipe_paket">Harga Tipe Paket</label>
            <input type="number" class="form-control" id="harga_tipe_paket" name="harga_tipe_paket"  required=""></input>
        </div>

         <div class="form-group">
            <label for="deskripsi_tipe_paket">Deskripsi Tipe Paket</label>
            <textarea type="text" class="form-control" id="deskripsi_tipe_paket" name="deskripsi_tipe_paket"  required=""></textarea>
        </div>

        <div class="form-group">
            <label for="min_dp">Minimal DP</label>
            <input type="number" class="form-control" id="min_dp" name="min_dp"  required=""></input>
        </div>

        <div class="form-group">
            <label for="jumlah_orang">Jumlah Orang</label>
            <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang"  required=""></input>
        </div>

        <div class="form-group">
            <label for="jumlah_pose">Jumlah Pose</label>
            <input type="number" class="form-control" id="jumlah_pose" name="jumlah_pose"  required=""></input>
        </div>

        <div class="form-group">
            <label for="jumlah_file">Jumlah File</label>
            <input type="number" class="form-control" id="jumlah_file" name="jumlah_file"  required=""></input>
        </div>

        <div class="form-group">
            <label for="foto_tipe_paket">Foto Tipe Paket</label>
            <input type="file" class="form-control" id="foto_tipe_paket" name="foto_tipe_paket"></input>
        </div>

        <input type="hidden" class="form-control" id="id_paket" name="id_paket" value="{{$id_paket}}"></input>


    </div>
    <div class="modal-footer">
      <button class="btn btn-primary" type="Submit">Tambahkan</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

  </div>
</form>
</div>
</div>
</div>








<!-- Modal Update -->
<div id="updateInformasi" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <!--Modal content-->
   <form action="" id="updateInformasiform" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Anda yakin ingin memperbarui Data Paket ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('POST') }}

        <div class="form-group">
          <label for="nama_tipe_paket">Nama Tipe Paket</label>
          <input type="text" class="form-control" id="nama_tipe_paket_update" name="nama_tipe_paket"  required=""></input>
        </div>

        <div class="form-group">
          <label for="harga_tipe_paket">Harga Tipe Paket</label>
          <input type="number" class="form-control" id="harga_tipe_paket_update" name="harga_tipe_paket"  required=""></input>
        </div>

        <div class="form-group">
          <label for="deskripsi_tipe_paket">Deskripsi Tipe Paket</label>
          <textarea type="text" class="form-control" id="deskripsi_tipe_paket_update" name="deskripsi_tipe_paket"  required=""></textarea>
        </div>

        <div class="form-group">
          <label for="min_dp">Minimal DP</label>
          <input type="number" class="form-control" id="min_dp_update" name="min_dp"  required=""></input>
        </div>

        <div class="form-group">
          <label for="jumlah_orang">Jumlah Orang</label>
          <input type="number" class="form-control" id="jumlah_orang_update" name="jumlah_orang"  required=""></input>
        </div>

        <div class="form-group">
          <label for="jumlah_pose">Jumlah Pose</label>
          <input type="number" class="form-control" id="jumlah_pose_update" name="jumlah_pose"  required=""></input>
        </div>

        <div class="form-group">
          <label for="jumlah_file">Jumlah File</label>
          <input type="number" class="form-control" id="jumlah_file_update" name="jumlah_file"  required=""></input>
        </div>

        <div class="form-group">
          <label for="foto_tipe_paket">Foto Tipe Paket</label>
          <input type="file" class="form-control" id="foto_tipe_paket_update" name="foto_tipe_paket"></input>
        </div>

      </div> 
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary float-right mr-2" >Perbarui</button>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </form>
</div>
</div>




<!-- Modal konfirmasi Hapus -->
<div id="DeleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <form action="" id="deleteForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Data Tipe Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      {{ csrf_field() }}
      {{ method_field('POST') }}
      <p>Apakah anda yakin ingin menghapus data Tipe paket ini ?</p>
      <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
      <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
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
  function deleteData(id) {
    var id = id;
    var url = '{{route("admin_detail_paket_delete", ":id") }}';
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
      $('#nama_tipe_paket_update').val(data[1]);
      $('#harga_tipe_paket_update').val(data[2]);
      $('#deskripsi_tipe_paket_update').val(data[3]);
      $('#min_dp_update').val(data[5]);
      $('#jumlah_orang_update').val(data[7]);
      $('#jumlah_pose_update').val(data[8]);
      $('#jumlah_file_update').val(data[9]);
      $('#updateInformasiform').attr('action','admin_detail_paket_update/'+ data[10]);
      $('#updateInformasi').modal('show');
  });
  });
</script>


@endsection                  
