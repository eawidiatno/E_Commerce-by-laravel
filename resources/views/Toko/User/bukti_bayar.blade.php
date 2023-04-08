@extends('Toko.layouts.layout_member')

@section('toko_eka')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('data_transaksi') }}">Order List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Upload Bukti Bayar</li>
                </ol>
            </nav>
        </div>
        <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Upload Bukti Bayar</h3>
        </div>
            @if(session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{session('success')}}
            </div>
            @endif
        <div class="card-body">
          <form action="{{ url('/save_bukti') }}/{{ $cart->id }}" method="post" enctype="multipart/form-data" class="form-inline">
          @csrf
          <div class="form-group">
            <div class="mb-3">
                <input type="file" id="bukti_bayar" name="bukti_bayar" class="form-control">
                <button type="submit" id="submitUpload" class="btn btn-primary">Upload</button>
          </div>
          </form>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col col-lg-3 col-md-3 mb-2">
              <img src="{{ asset('/images/'.$cart->bukti_bayar) }}" alt="img" class="img-thumbnail mb-2">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <a href="{{ url('/data_transaksi') }}" class="btn btn-sm btn-danger">Tutup</a>
        </div>
@endsection