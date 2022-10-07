@extends('layouts.app_admin')

@section('title')
Kelola Paket
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
                    <h3 class="mb-1">KELOLA PAKET FOTO</h3><br>
                    <div class="text-left">    
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalTambah">
                            Tambah Paket
                        </button><br><hr>  
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped" style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Paket</th>
                              <th>Foto</th>
                              <th>Opsi</th>

                              <th style="display: none;">hidden</th>
                          </tr>
                      </thead>
                      <tbody>
                         @php $no=1 @endphp
                         @foreach($paket as $data)
                         <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->nama_paket }}</td>
                          <td><img style="border-radius: 0%" height="70" id="ImageTampil" src="{{asset('uploads/foto_paket/'.$data->foto_paket)}}"  data-toggle="modal" data-target="#myModal"></img></td>
                          
                          <td>
                             <a href="{{ route('admin_detail_paket',$data->id) }}"><button class="btn btn-success btn-sm ">Detail</button></a> 

                            <button class="btn btn-warning btn-sm edit" title="Edit">Edit</button>

                            <a href="#" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal">
                              <button class="btn btn-danger btn-sm"  title="Hapus">Hapus</button>
                          </a>

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





<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Tambah Data Paket Foto</h5>
    </div>
    <div class="modal-body">
     <form method="post" action="{{route('admin_kelola_paket_add')}}" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" class="form-control" id="nama_paket" name="nama_paket"  required=""></input>
        </div>

        <div class="form-group">
            <label for="foto_paket">Foto Paket</label>
            <input type="file" class="form-control" id="foto_paket" name="foto_paket"></input>
        </div>

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
                <label for="nama_paket">Nama Paket</label>
                <input type="text" class="form-control" id="nama_paket_update" name="nama_paket"  required=""></input>
            </div>

            <div class="form-group">
                <label for="foto_paket">Foto Paket</label>
                <input type="file" class="form-control" id="foto_paket_update" name="foto_paket"></input>
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
          <h5 class="modal-title">Hapus Data Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      {{ csrf_field() }}
      {{ method_field('POST') }}
      <p>Apakah anda yakin ingin menghapus data paket ini ?</p>
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
