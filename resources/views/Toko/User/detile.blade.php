@extends('Toko.layouts.layout_member')

@section('toko_eka')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('data_transaksi') }}">Order List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detile Transaksi</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3> Sukses Check Out</h3>
                    <div class="card-body">
                    <h5>Pesanan anda sudah sukses dicheck out, selanjutnya untuk pembayaran silahkan transfer ke rekening <br><strong>Bank BRI Nomer Rekening : 32113-821312-123</strong> dengan nominal : <strong>Rp. {{ number_format($all_cart->kode+$all_cart->total_harga) }}</strong></h5>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <table class="table table-striped">
                    <p align="right">Tanggal Pesan : {{ $all_cart->tanggal }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>              
                            </tr>
                        </thead>
                        <tbody>
                            <?php   $no = 1;
                                    $grandtotal=0;
                             ?>
                             @foreach($cart_details as $carts)
                                @php
                                    $grandtotal+=$carts->total_harga;
                                @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                <img src="{{ url('images') }}/{{ $carts->foto_produk }}" class="rounded" width="100" alt="">
                                </td>
                                <td>{{ $carts->nama_produk }}</td>
                                <td>{{ $carts->jumlah }} unit</td>
                                <td>Rp. {{ number_format($carts->harga_satuan) }}</td>
                                <td>Rp. {{ number_format($carts->total_harga) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-5 float-right">
                    <div class="card">
                        <div class="card border-primary">
                        <div class="card-body">
                            <table class="table table-striped">
                            <tr>
                                <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($grandtotal) }}</strong></td>
                                
                            </tr>
                            <tr>
                                <td colspan="5" align="right"><strong>Kode Unik :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($all_cart->kode) }}</strong></td>
                                
                            </tr>
                             <tr>
                                <td colspan="5" align="right"><strong>Total yang harus ditransfer :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($all_cart->kode+$all_cart->total_harga) }}</strong></td>
                            </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-block"><a href="{{ url('bukti_transfer') }}" class="btn btn-primary btn-block" onclick="return confirm('Terimakasih sudah berbelanja :)');"> Konfirmasi</a></button>
                        </div>
                    </div>
                </div>
            </div>
                </div>             
            </div>
        </div>
    </div>
</div>
</div>
@endsection