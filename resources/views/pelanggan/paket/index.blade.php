@extends('layouts.app')

@section('title')
Paket
@endsection


@section('content')




<div class="row match-height">


    @foreach($paket as $data)
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card ecommerce-card">
            <div class="item-img text-center">
                <img class="img-fluid card-img-top" src="{{asset('uploads/foto_paket/'.$data->foto_paket)}}" alt="img-placeholder" />
            </div>
            <div class="card-header flex-column align-items-start pb-0">
                <div class="item-wrapper">
                <div class="text-center">
                    <h6 class="item-price text-center"><b>{{$data->nama_paket}}</b></h6>
                </div>
            </div>
        </div><br>
        <div class="card-body">
            <div class="text-center">
                <a href="{{ route('tipe_paket',$data->id) }}"><button class="btn btn-success btn-lg">Lihat Detail</button></a>
            </div>
        </div>

    </div>
</div>
@endforeach


@endsection