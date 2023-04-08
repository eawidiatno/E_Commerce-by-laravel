<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Toko Widiatno</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
        crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" 
        crossorigin="anonymous"></script>

        <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        -->

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            nav ul>li>a:hover{
                font-size: xx-large;
                color: #fff;
            }
            .medsos{
                background-color: rgb(192, 192, 192);
            }
            .medsos ul li{
                display: inline-block;
                color: #fff;
                margin-right: 1px;
                padding-bottom: -100px;
            }
        </style>
    </head>
    <body>
    <div class='container-fluid bg-info text-white sticky-top'>
        <i class='top-header-date-icon bi bi-calendar'></i>
        <script>
        var d=new Date();
        var weekday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
        var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
        document.write(weekday[d.getDay()] + ", ");
        document.write(monthname[d.getMonth()] + " ");
        document.write(d.getDate() + " ");
        document.write(d.getFullYear());
        </script>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-white text-primary mb-2 sticky-top shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand text-primary" style="font-family:Brush Script MT;font-size:40px">
                <img src="{{ asset('images/logo.jpg') }}" alt="logo" width="50" height="50"> Widiatno
            </a>

            <div id="navbarNav">
            <ul class="mr-auto navbar-nav"></ul>
                @if (Route::has('login'))
                <ul class="navbar-nav">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-primary inline-block" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item ">
                        <a class="nav-link text-primary inline-block" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @endauth
                </ul>
                @endif    
                </div>
            </div>
            </nav>

            <div class="container">
            <!-- carousel -->
            <div class="row">
                <div class="col">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>
            </div>
            <!-- end carousel -->
            <!-- produk Terbaru-->
<div class="container">
<div class="row mt-4">
    <div class="col col-md-12 col-sm-12 mb-0">
      <h2 class="text-center">Daftar Produk</h2>
    </div>
  <div class="row mt-0">
    <div class="col col-md-12 col-sm-12 mb-4">
    </div>
    @foreach($data as $item)
    <div class="col-md-3 mt-2">
      <div class="card mb-2 shadow-sm">
        <a><img src="{{asset('/images/'.$item->foto_produk)}}" alt="foto produk" class="card-img-top" style="height:200px">
        </a>
        <div class="card-body">
          <a class="text-decoration-none">
            <h4 class="card-text">
              {{ $item->nama_produk }}
            </h4>
            <p>
               Rp. {{number_format($item->harga_satuan) }}
              </p>
          </a>
            <div class="container pr-3 pl-3">
            <a href="{{ url('detile_produk',$item->id)}}" class="btn btn-block btn-primary">
            <i class="bi bi-cart3"></i> Pesan</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
        <hr>
    <div class="container">
  <div class="row mt-4">
    <div class="col-md-12">
      <h5 class="text-center">Toko Widiatno</h5>
      <p>
        Toko online ini dibangun menggunakan laravel framework. Di dalam demo ini terdapat admin CRUD produk, Update Order & Laporan Transaksi.
        Sedangkan untuk user dapat melakukan add cart, & checkout.
      </p>
      <p class="text-center">
        <a href="" class="btn btn-outline-secondary">
          Baca Selengkapnya
        </a>      
      </p>
      </div>
    </div>
  </div>
  <div class="container">
  <div class="row">
    <div class="col">
      <hr />
      <p>&copy Copyright Eka Ari Widiatno - 2022</p>
    </div>
  </div>
</div>
    </body>
</html>
