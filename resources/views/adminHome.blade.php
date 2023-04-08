@extends('Toko.layouts.layout_admin')

@section('toko_eka')
<div class="container text-center bg-success">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
     {{ __('You are logged in Admin!') }}      
</div>
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
              {{ $item['nama_produk'] }}
            </h4>
            <p>
               Rp. {{number_format($item['harga_satuan']) }}
              </p>
          </a>
            <div class="container pr-3 pl-3">
              <a href="{{ url('/update_produk/'.$item->id)}}" class="btn btn-block btn-primary">
              <i class="bi bi-pencil-square"></i> Edit</a>
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
@endsection
