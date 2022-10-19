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

 <section id="basic-carousel">
                    <div class="row">
                       
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                               
                                <div class="card-body">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="img-fluid" src="{{ asset('img/banner/1.jpg') }}" alt="First slide" />
                                            </div>
                                            <div class="carousel-item">
                                                <img class="img-fluid" src="{{ asset('img/banner/2.jpg') }}" alt="Second slide" />
                                            </div>
                                            <div class="carousel-item">
                                                <img class="img-fluid" src="{{ asset('img/banner/3.jpg') }}" alt="Third slide" />
                                            </div>
                                            <div class="carousel-item">
                                                <img class="img-fluid" src="{{ asset('img/banner/4.jpg') }}" alt="fourth slide" />
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                               
                                <div class="card-body">
                                   
                                    <div id="carousel-interval" class="carousel slide" data-ride="carousel" data-interval="5000">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-interval" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-interval" data-slide-to="1"></li>
                                            <li data-target="#carousel-interval" data-slide-to="2"></li>
                                            <li data-target="#carousel-interval" data-slide-to="3"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="img-fluid" src="{{ asset('img/banner/5.jpg') }}" alt="First slide" />
                                            </div>
                                            <div class="carousel-item">
                                                <img class="img-fluid" src="{{ asset('img/banner/6.jpg') }}" alt="Second slide" />
                                            </div>
                                            <div class="carousel-item">
                                                <img class="img-fluid" src="{{ asset('img/banner/7.jpg') }}" alt="Third slide" />
                                            </div>
                                            <div class="carousel-item">
                                                <img class="img-fluid" src="{{ asset('img/banner/8.jpg') }}" alt="fourth slide" />
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel-interval" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-interval" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><br><hr>


    <!-- alamat -->
    <div class="col-12">
        <div class="card ecommerce-card">
            <div class="item-img text-center"><br>
                <h3 class="item-price text-center text-primary"><b>ALAMAT</b></h3>

            </div>
           
            <div class="card-body">
                <div class="item-wrapper">
                    <div class="text-center">
                       <div class="text-center">

                           <span data-feather="map-pin"> </span>
                             Jalan ikan kembang waru, Karangrejo, Banyuwangi<br>
                        

                     </div>
                 </div>
                 <hr>
                 <div class="row">
                   <div class="col-1"></div>
                 <div class="col-5">
                   <div class="text-center">
                    <h4 class="item-price text-center text-primary"><b>Email</b></h4>
                    <span data-feather="mail"> </span>
                      kiephoto@gmail.com
                    

                  </div>
                </div>

                 <div class="col-5">
                   <div class="text-center">
                    <h4 class="item-price text-center text-primary" ><b>No Telepon</b></h4>
                    <span data-feather="phone"> </span>
                      +62852-3600-0707
                  
                  </div>
                </div>
                <div class="col-1"></div>
                 </div>
            </div>   
        </div>
    </div>
</div>

@endsection