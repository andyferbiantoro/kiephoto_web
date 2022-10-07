@extends('layouts.app')

@section('title')
Dashboard
@endsection


@section('content')



<div class="col-12">

    @if (session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
  </div>
  @endif
  @if (session('error'))
  <div class="alert alert-danger text-center">
      {{ session('error') }}
  </div>
  @endif
</div>
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
                    <a href="{{ route('tipe_paket',$data->id) }}"><button class="btn btn-primary btn-lg">Lihat Detail</button></a>
                </div>
            </div>

        </div>
    </div>
    @endforeach


    <!-- alamat -->
    <div class="col-12">
        <div class="card ecommerce-card">
            <div class="item-img text-center"><br>
                <h3 class="item-price text-center text-primary"><b>ALAMAT</b></h3><br>

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
                       <div class="text-center">

                           <p>
                             Jalan ikan kembang waru, Karangrejo, Banyuwangi<br>
                         </p>

                     </div>
                 </div>
                 <hr>
                 <div class="text-center">
                    <h4 class="item-price text-center text-primary"><b>Email</b></h4><br>
                    <p>
                        kiephoto@gmail.com
                    </p>

                </div><br>
            </div>   
        </div>
    </div>
</div>
@endsection