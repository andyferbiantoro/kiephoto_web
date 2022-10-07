@extends('layouts.app')

@section('title')
Konfirmasi Pembayaran
@endsection


@section('content')




<div class="row match-height">


   <div class="col-12">
    <div class="card ecommerce-card">
        <div class="item-img text-center"><br>
            <h3 class="item-price text-center text-primary"><b>Pembayaran Paket</b></h3><br>

        </div>
        <div class="card-header flex-column align-items-start pb-0">
            <div class="item-wrapper">
                <div class="text-center">

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="item-wrapper">
                <div class="row">


                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                     <form method="post" action="{{route('pelanggan_pembayaran_add')}}" enctype="multipart/form-data">

                        {{csrf_field()}}

                        @foreach($pemesanan as $data)
                        <div class="form-group">
                            <label for="kode_pemesanan">Kode Pemesanan</label>
                            <input type="text" class="form-control" id="kode_pemesanan" readonly=""  value="{{$data->kode_pemesanan}}"></input>
                        </div>

                        <div class="form-group">
                            <label for="jenis_pembayaran">Jenis Pembayaran</label>
                            <input type="text" class="form-control" id="jenis_pembayaran" readonly=""  value="{{$data->jenis_pembayaran}}"></input>
                        </div>

                        @if($data->jenis_pembayaran == 'DP')    
                        <div class="form-group">
                            <label for="jenis_pembayaran">Jumlah Pembayaran</label>
                            <input type="text" class="form-control" id="jenis_pembayaran" readonly=""  value="{{$data->nominal_dp}}"></input>
                        </div>
                        @elseif($data->jenis_pembayaran == 'Lunas')
                        <div class="form-group">
                            <label for="jenis_pembayaran">Jumlah Pembayaran</label>
                            <input type="text" class="form-control" id="jenis_pembayaran" readonly=""  value="{{$data->nominal_dp}}"></input>
                        </div>
                        @endif

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id_pemesanan" name="id_pemesanan" readonly=""  value="{{$data->id}}"></input>
                        </div>

                        @endforeach
                        <div class="form-group">
                            <label for="nama_rekening">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" ></input>
                        </div>

                        <div class="form-group">
                            <label for="no_rekening">No Rekening</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" ></input>
                        </div>

                        <div class="form-group">
                            <label for="nama_bank">Nama Bank</label>
                            <input type="text" class="form-control" id="nama_bank" name="nama_bank" ></input>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_bayar">Tanggal Bayar</label>
                            <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" ></input>
                        </div>

                        <div class="form-group">
                            <label for="foto_bukti_bayar">Foto Bukti Bayar</label>
                            <input type="file" class="form-control" id="foto_bukti_bayar" name="foto_bukti_bayar" ></input>
                        </div>

                        

                        <button class="btn btn-primary" type="Submit">Submit</button>
                    </div>


                </form>

            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>   
</div>
</div>
</div>



<!-- Orders Chart Card ends -->
</div>


@endsection

@section('scripts')
<script type="text/javascript">
 

        function JenisPembayaranFunction(){
            var jenis_pembayaran = document.getElementById("jenis_pembayaran").value;
            var nominal_dp = document.querySelector("#nominal_dp");
           


            if(jenis_pembayaran == "DP"){    
               nominal_dp.removeAttribute("disabled");
              


           }else{
            nominal_dp.setAttribute("disabled", "");
        }
    }
</script>




@endsection           