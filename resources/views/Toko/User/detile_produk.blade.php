@extends('Toko.layouts.layout_member')

@section('toko_eka')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $daftar_produk->nama_produk}}</li>
        </ol>
        </nav>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <img src="{{ url('images') }}/{{ $daftar_produk->foto_produk }}" class="rounded mx-auto d-block" width="100%" alt="">
                        </div>
                        <div class="col-md-6 mt-5">
                                    @if(session('stock'))
                                    <div class="container alert alert-danger text-center" role="alert">
                                        {{session('stock')}}
                                    </div>
                                    @endif
                            <h2>{{ $daftar_produk->nama_produk}}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td> : </td>
                                        <td>Rp. {{ (number_format($daftar_produk->harga_satuan))}}</td>
                                    </tr>
                                    <tr>
                                        <td>Stock</td>
                                        <td> : </td>
                                        <td>{{ $daftar_produk->stock}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td> : </td>
                                        <td>{{ $daftar_produk->kategori}}</td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td> : </td>
                                        <td>
                                        <form action="{{url('detile_produk',$daftar_produk->id)}}" method="POST"> <!--ambil dari route-->
                                            @csrf
                                            <input type="text" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
                                            <input type="number" id="produk_id" name="produk_id" value="{{ $daftar_produk->id }}" hidden>
                                            <input type="number" id="harga_satuan" name="harga_satuan" value="{{ $daftar_produk->harga_satuan }}" hidden>
                                            <input type="file" id="foto_produk" name="foto_produk" value="{{ $daftar_produk->foto_produk }}" hidden>
                                            <input class="form-control" type="number" id="jumlah" name="jumlah" min="1" required="" style="width: 100px;">
                                            <button type="submit" onclick="addCart()" id="AddCart" class="btn btn-primary mt-3"><i class="bi bi-cart3"></i> Add Cart</button>
                                        </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    function addCart(){
        var jumlah = $('#jumlah').value;
        var user_id = $('#user_id').val();
        //console.log(jumlah);
    
//    if (jumlah <= 0){
//        swal("Oops!", "Jumlah Produknya berapa?", "error");
//    }else{
//        swal("Yeay!", "Produk berhasil add ke keranjang", "success");
//    }
    documen.getElementById('AddCart').click();
    }
        
</script>
@endsection