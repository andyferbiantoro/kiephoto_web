@extends('layouts.app')

@section('title')
Pemesanan
@endsection


@section('content')




<div class="row match-height">


   <div class="col-12">
    <div class="card ecommerce-card">
        <div class="item-img text-center"><br>
            <h3 class="item-price text-center text-primary"><b>Pemesanan Paket</b></h3><br>

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
                     <form method="post" action="{{route('pelanggan_pemesanan_add')}}" enctype="multipart/form-data">

                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="nama_paket">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_paket" readonly=""  value="{{$nama_pelanggan}}"></input>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id_pelanggan" name="id_pelanggan" readonly=""  value="{{$id_pelanggan}}"></input>
                        </div>

                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nama_paket"  readonly=""  value="{{$no_telp}}"></input>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal Pemesanan</label>
                            <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" required=""  ></input>
                        </div>

                        @foreach($tipe_paket as $data)
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id_tipe_paket" name="id_tipe_paket" readonly=""  value="{{$data->id}}"></input>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="jumlah_pose_pemesanan" name="jumlah_pose_pemesanan" readonly=""  value="{{$data->jumlah_pose}}"></input>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="jumlah_file_pemesanan" name="jumlah_file_pemesanan" readonly=""  value="{{$data->jumlah_file}}"></input>
                        </div>

                        <div class="form-group">
                            <label for="no_telp">Paket</label>
                            <input type="text" class="form-control" id="nama_paket"  readonly=""  value="{{$data->nama_paket}}"></input>
                        </div>

                        <div class="form-group">
                            <label for="nama_tipe_paket">Tipe Paket</label>
                            <input type="text" class="form-control" id="nama_tipe_paket"  readonly=""  value="{{$data->nama_tipe_paket}}"></input>
                        </div>


                        <div class="form-group">
                            <label for="jumlah_orang">Jumlah Orang (Max {{$data->jumlah_orang}} Orang)</label>
                            <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang"  min="1" max="{{$data->jumlah_orang}}"></input>
                        </div>

                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" required="" onchange="MetodePembayaranFunction()">
                                <option selected value=""> -- Pilih Metode Pembayaran -- </option>
                                <option value="Transfer">Transfer</option>
                                <option value="Tunai">Tunai</option>
                            </select><br>
                        </div>

                       <!--  <div class="form-group">
                            <input type="text" class="form-control" id="jenis_pembayaran_tunai" name="jenis_pembayaran" disabled="" readonly=""  value="Lunas"></input>
                        </div> -->


                        <div class="form-group">
                            <label>Jenis Pembayaran</label>
                            <select type="text" class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required="" onchange="JenisPembayaranFunction()">
                                <option selected value=""> -- Pilih Jenis Pembayaran -- </option>
                                <option value="DP">DP</option>
                                <option value="Lunas">Lunas</option>
                            </select><br>
                        </div>

                        <div class="form-group">
                            <label for="nominal_dp">Nominal DP (Minimal DP Rp. <?=number_format($data->min_dp, 0, ".", ".")?>,00)</label>
                            <input type="number" class="form-control" min="{{$data->min_dp}}" id="nominal_dp" disabled="" name="nominal_dp" required=""></input>
                        </div>

                        <div class="form-group">
                            <label for="total_bayar">Total Pembayaran</label>
                            <input type="number" class="form-control" id="total_bayar" readonly="" name="total_bayar" value="{{$data->harga_tipe_paket}}"  required=""></input>
                        </div>


                        @endforeach

                        <button class="btn btn-primary" type="Submit">Tambahkan</button>
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

     function MetodePembayaranFunction(){
            var metode_pembayaran = document.getElementById("metode_pembayaran").value;
            var jenis_pembayaran = document.querySelector("#jenis_pembayaran");
           


            if(metode_pembayaran == "Tunai"){    
               document.getElementById("jenis_pembayaran").selectedIndex = "2";
           }else{
            document.getElementById("jenis_pembayaran").selectedIndex = "0";
        }
    }
</script>




@endsection           