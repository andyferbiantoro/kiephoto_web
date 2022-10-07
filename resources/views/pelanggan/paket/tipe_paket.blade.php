@extends('layouts.app')

@section('title')
Tipe Paket
@endsection


@section('content')




<div class="row match-height">


    @foreach($tipe_paket as $data)
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card ecommerce-card">
            <div class="item-img text-center"><br>
                <h4 class="item-price text-center"><b>{{$data->nama_tipe_paket}}</b></h4><br>
                <img class="img-fluid card-img-top" src="{{asset('uploads/foto_tipe_paket/'.$data->foto_tipe_paket)}}" alt="img-placeholder" />
            </div>
            <div class="card-header flex-column align-items-start pb-0">
                <div class="item-wrapper">
                <div class="text-center">
                    
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="item-wrapper">
                <div class="text-center">
                    Tersedia <b class="text-warning">{{ $data->jumlah_pose }} Pose </b> dan <b class="text-success">{{ $data->jumlah_file }} File</b> 
                </div>
                <hr>
                <div class="text-center">
                     Jumlah Orang : <b class="text-primary">{{ $data->jumlah_orang }} Orang </b> <br>
                     Harga : <b class="text-primary">Rp. <?=number_format($data->harga_tipe_paket, 0, ".", ".")?>,00 </b> <br>
                     Minimal DP : <b class="text-primary">Rp. <?=number_format($data->min_dp, 0, ".", ".")?>,00</b> <br>

                </div><br>
            </div>
            @auth
            <div class="text-center">
                <a href="{{ route('pelanggan_pemesanan',$data->id) }}"><button class="btn btn-success btn-lg">Pesan</button></a>
            </div>
            @endauth

            @guest
            <a class="btn btn-primary ml-50" href="{{ route('login') }}">
                <i class="mr-50" data-feather="log-in"></i> Silahkan Login terlebih dahulu
            </a>
            @endguest
        </div>

    </div>
</div>
@endforeach


@endsection