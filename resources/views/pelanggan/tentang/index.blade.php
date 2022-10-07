@extends('layouts.app')

@section('title')
Tentang
@endsection


@section('content')




<div class="row match-height">


   <div class="col-12">
        <div class="card ecommerce-card">
            <div class="item-img text-center"><br>
                <h1 class="item-price text-center text-primary"><b>TENTANG KAMI</b></h1><br>
               
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
                    <h4 class="text-center">Profil</h4> 
                </div>
                <hr>
                <div class="text-center">
                     
                     <p>
                        Kiephoto adalah studio fotografi yang memberikan pelayanan jasa fotografi,<br>
                        dimana pelayanan tersebut diantaranya graduation & family, group, couple, dan personal. <br>
                        Pelayanan ramah dan harga ekonomis
                     </p>

                </div><br>
            </div>   
        </div>
    </div>
</div>



@foreach($Portofolio as $data)
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card ecommerce-card">
            <div class="item-img text-center">
                <img class="img-fluid card-img-top" src="{{asset('uploads/foto/'.$data->foto)}}" alt="img-placeholder" />
            </div>
            <div class="card-header flex-column align-items-start pb-0">
                <div class="item-wrapper">
                <div class="text-center">
                    <h6 class="item-price text-center"><b>{{$data->keterangan   }}</b></h6>
                </div>
            </div>
        </div><br>
        <div class="card-body">
           <!--  <div class="text-center">
                <a href="{{ route('tipe_paket',$data->id) }}"><button class="btn btn-success btn-lg">Lihat Detail</button></a>
            </div> -->
        </div>

    </div>
</div>
@endforeach


<!-- Orders Chart Card ends -->
</div>





@endsection