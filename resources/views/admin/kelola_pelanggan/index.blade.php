@extends('layouts.app_admin')

@section('title')
Kelola Pelanggan
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
                    <h3 class="mb-1">KELOLA PELANGGAN</h3><br>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped" style="width:100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Username</th>
                              <th>Email</th>
                              <th>No Telepon</th>
                              <th>Alamat</th>
                              <th>Opsi</th>

                              <th style="display: none;">hidden</th>
                          </tr>
                      </thead>
                      <tbody>
                         @php $no=1 @endphp
                         @foreach($pelanggan as $data)
                         <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->nama_lengkap }}</td>
                          <td>{{$data->username }}</td>
                          <td>{{$data->email }}</td>
                          <td>{{$data->no_telp }}</td>
                          <td>{{$data->alamat }}</td>
                          <td>

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



<!-- Modal konfirmasi Hapus -->
<div id="DeleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <form action="" id="deleteForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Data Pelanggan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      {{ csrf_field() }}
      {{ method_field('POST') }}
      <p>Apakah anda yakin ingin menghapus data wali nikah pelanggan ini ?</p>
      <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
      <button type="submit" name="" class="btn btn-danger float-right mr-2" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
  </div>
</div>
</form>
</div>
</div> 

@endsection    

@section('scripts')
<script type="text/javascript">
  function deleteData(id) {
    var id = id;
    var url = '{{route("admin_kelola_pelanggan_delete", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
}

function formSubmit() {
    $("#deleteForm").submit();
}
</script>
@endsection                
