@extends('layouts.app')

@section('title')
Edit Profil
@endsection


@section('content')




<div class="row match-height">


   <div class="col-12">
    <div class="card ecommerce-card">
        <div class="item-img text-center"><br>
            <h3 class="item-price text-center text-primary"><b>EDIT PROFIL</b></h3><br>

        </div>
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
                         <form method="post" action="{{route('pelanggan_profil_update')}}" enctype="multipart/form-data">

                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$data->nama_lengkap}}"  ></input>
                            </div>

                            <div class="form-group">
                                <label for="no_telp">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{$data->no_telp}}"  ></input>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data->alamat}}"  ></input>
                            </div>

                            <div class="form-group">
                                <label for="password_lama">Password_lama</label>
                                <input type="text" class="form-control" id="password_lama" name="password_lama" value="{{ old('password_lama') }}" ></input>
                            </div>


                            <div class="form-group" >
                                <label>Password</label>
                                <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" autocomplete="password" placeholder="masukkan password">
                            </div class="form-group">
                            <div >
                                <label>Ulangi Password</label>
                                <input type="password" name="repassword" class="form-control  @error('password') is-invalid @enderror" autocomplete="password" placeholder="ulangi password">
                            </div><br>


                            <button class="btn btn-primary" type="Submit">Perbarui</button><br><br>
                        </div>


                    </form><br><br>
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