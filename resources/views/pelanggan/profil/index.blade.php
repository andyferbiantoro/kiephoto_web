@extends('layouts.app')

@section('title')
Profil
@endsection


@section('content')




<div class="row match-height">


 <div class="col-12">
    <div class="card ecommerce-card">
        <div class="item-img text-center"><br>
            <h3 class="item-price text-center text-primary"><b>PROFIL</b></h3><br>

        </div>
        <div class="card-header flex-column align-items-start pb-0">
            <div class="item-wrapper">
                <div class="text-center">

                </div>
            </div>
        </div>
        @foreach($pelanggan as $data)
        <div class="card-body">
            <div class="item-wrapper">
                <div class="text-center">
                  <div class="table-responsive">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8 text-left">
                           <table class="table table-striped">
                              <tr>
                                <th>Nama Member</th>
                                <th>:</th>
                                <td>{{$data->nama_lengkap}}</td>
                            </tr> 

                            <tr>
                                <th>Email</th>
                                <th>:</th>
                                <td>{{$data->email}}</td>
                            </tr> 

                            <tr>
                                <th>No Telepon</th>
                                <th>:</th>
                                <td>{{$data->no_telp}}</td>
                            </tr>

                            <tr>
                                <th>Alamat</th>
                                <th>:</th>
                                <td>{{$data->alamat}}</td>
                            </tr> 
                        </table><br>
                        <a href="{{ route('pelanggan_profil_edit',$data->id) }}"><button class="btn btn-success btn-sm ">Update Profil</button></a><br><br>
                    </div>
                    <div class="col-2"></div>
                </div>

            </div>
        </div>
    </div>   
</div>
@endforeach
</div>
</div>






<!-- Orders Chart Card ends -->
</div>






@endsection