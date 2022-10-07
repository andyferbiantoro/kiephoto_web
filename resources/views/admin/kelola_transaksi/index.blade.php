@extends('layouts.app_admin')

@section('title')
Laporan Transaksi
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
                    <h3 class="mb-1">LAPORAN TRANSAKSI</h3><br>
                    <div class="col-12">
                        <form action="{{route('admin_kelola_laporan_transaksi')}}" method="GET">
                          <div class="row">
                            <div class="col-lg-2">
                              <div class="form-row">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" name="from" placeholder="Cari tanggal .." value="{{ old('from') }}">
                            </div>
                        </div>

                        <div class="col-lg-2">
                         <div class="form-row">
                          <label>Sampai Tanggal</label>
                          <input type="date" class="form-control" name="to" placeholder="Cari tanggal .." value="{{ old('to') }}">
                      </div>
                  </div><br><br>

                  <div class="col-lg-2">
                    <div class="form-row">
                        
                    <input type="submit" class="btn btn-primary" value="Filter">
                    </div>
                </div>
            </div> 
            </form><br>
            <div class="col-lg-2"> 
               <button class="btn btn-success" onclick="print('printPDF')">Cetak PDF</button>
           </div>
                    </div><br><br><br>
                    <div id="printPDF">
                    @if($from == null && $to == null)
                    <div class="row">
                        <div class="col-lg-12"><p style="color: red" class="text-center">Tanggal Tidak Difilter</p></div>
                    </div><br>
                    @endif
                    @if($from != null && $to != null)
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">Mulai tanggal : {{date("j F Y", strtotime($from))}}</div>
                        <div class="col-lg-4">Sampai tanggal : {{date("j F Y", strtotime($to))}}</div>
                        <div class="col-lg-2"></div>
                    </div><br><br>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover" style="width:100%" border="1">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Kode Pemesanan</th>
                              <th>Pelanggan</th>
                              <th>Tanggal Pemesanan</th>
                              <th>Jumlah Orang</th>
                              <th>Total Bayar</th>
                              <th>Opsi</th>

                             
                          </tr>
                      </thead>
                      <tbody>
                         @php $no=1 @endphp
                         @foreach($transaksi as $data)
                         <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->kode_pemesanan }}</td>
                          <td>{{$data->nama_lengkap }}</td>
                          <td>{{date("j F Y", strtotime($data->tanggal_pemesanan))}}</td>
                          <td>{{$data->jumlah_orang }} Orang</td>
                          <td>Rp. <?=number_format($data->total_bayar, 0, ".", ".")?>,00</td>
                          <td>{{$data->status_pemesanan }}</td>


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
      <p>Apakah anda yakin ingin menghapus data pelanggan ini ?</p>
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
    function print(elem) {
        var mywindow = window.open('', 'PRINT', 'height=1000,width=1200');
       
        mywindow.document.write('<html><head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">');
        mywindow.document.write('<h1 style="text-align:center;">' + 'Laporan Transaksi Kiephoto' + '</h1>');
        mywindow.document.write('<br><br>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    // mywindow.close();

    return true;

}

</script>


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
