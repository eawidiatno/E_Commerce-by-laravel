@extends('Toko.layouts.layout_member')

@section('toko_eka')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order List</li>
                </ol>
            </nav>
            @if(session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{session('success')}}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                <h4 class="cart-title">Order List</h4>
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Status Pengiriman</th>
                                <th>Jumlah Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp

                            @foreach($cart as $data)
                            
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->tanggal}}</td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->status_pengiriman}}</td>
                                <td>Rp. {{ number_format($data->total_harga+$data->kode) }}</td>
                                <td>
                                    <a href="{{ url('data_transaksi') }}/{{ $data->id }}" class="btn btn-primary"><i class="bi bi-info"></i> Detail</a> / 
                                    <a href="{{ url('bukti_bayar') }}/{{ $data->id }}" class="btn btn-success"><i class="bi bi-upload"></i> Bukti Bayar</a>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
