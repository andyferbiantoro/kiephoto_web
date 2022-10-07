@extends('layouts.app_admin')

@section('title')
Ubah Password
@endsection


@section('content') 


<div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">


               
                <div class="text-center">
                    <h3 class="mb-1">UBAH PASSWORD</h3><br>
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
                    <div class="text-left">
                        
                    <div class="col-lg-8">

                        <form method="post" action="{{route('admin_update_password')}}" enctype="multipart/form-data">

                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="password_lama">Password_lama</label>
                                <input type="text" class="form-control" id="password_lama" name="password_lama" value="{{ old('password_lama') }}" ></input>
                            </div>


                            <div class="form-group" >
                                <label>Password</label>
                                <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" required autocomplete="password" placeholder="masukkan password">
                            </div class="form-group">
                            <div >
                                <label>Ulangi Password</label>
                                <input type="password" name="repassword" class="form-control  @error('password') is-invalid @enderror" required autocomplete="password" placeholder="ulangi password">
                            </div><br>


                            <button class="btn btn-primary" type="Submit">Ubah Password</button>
                        </div>


                    </form>
                </div>
                    </div>

            </div>
        </div>
    </div>
</div>

</div>

@endsection                    
