@extends('Toko.layouts.layout_admin')

@section('toko_eka')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
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
                                <th>Order ID</th>
                                <th>Tanggal</th>
                                <th>Jumlah Pesan</th>
                                <th>Total</th>
                                <th>Bukti Bayar</th>
                                <th>Status Pembayaran</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp

                            @foreach($all_transaksi as $data)
                            
                            <tr>
                                <td>{{$no++}}</td>
                                <td>INV-{{$data->id}}</td>
                                <td>{{$data->tanggal}}</td>
                                <td>{{$data->jumlah}}</td>
                                <td>Rp. {{number_format($data->total_harga)}}</td>
                                <td><img src="{{asset('/images/'.$data->bukti_bayar)}}" style="height:80px; width: 80px;"></td>
                                <td>{{$data->status_pembayaran}}</td>
                                <td>{{$data->status_pengiriman}}</td>
                                <td>
                                <form action="{{ asset('/images/'.$data->bukti_bayar) }}" method="post" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mb-2"><i class="bi bi-eye"></i>
                                    Bukti
                                    </button>
                                </form>
                                    <a href="{{ url('/update_transaksi/'.$data->id)}}" class="btn btn-sm btn-primary mb-2"><i class="bi bi-check2-circle"></i>
                                    Update
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
