@extends('Toko.layouts.layout_member')

@section('toko_eka')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
        </nav>
    <div class="row">
    <div class="col-lg-12">
    <h4 class="cart-title">Shopping Cart</h4>
    <br>
        <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="shopping_cart">
                @php
                    $no=1;
                    $grandtotal=0;
                @endphp

                @foreach($shopping_cart as $data)
                @php
                    $grandtotal+=$data->total_harga;
                @endphp
                <tr>
                    <td>{{$no++}}</td>
                    <td><img src="{{asset('/images/'.$data->foto_produk)}}" style="height:150px;width:150px"></td>
                    <td>{{$data->nama_produk}}</td>
                    <td>Rp. {{number_format($data->harga_satuan,2,',','.')}}</td>
                    <td>{{$data->jumlah}}</td>
                    <td>Rp. {{number_format($data->total_harga,2,',','.')}}</td>
                    <td>
                    <a class="btn btn-danger" onclick="hapusKeranjang({{$data->id_cart}})"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                @endforeach                
        </tbody>
    </table>
    </div>
</div>
<div class="col-md-4 float-right">
    <div class="card-checkout">
        <div class="card border-primary">
          <div class="card-body">
            <h4 class="card-title">Checkout</h4>
            <p class="card-text">Total :Rp. {{number_format($grandtotal,2,',','.')}}</p>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary btn-block"><a href="{{ url('/konfirmasi-check-out') }}" class="btn btn-primary btn-block" onclick="return confirm('Anda yakin akan Check Out ?');"><i class="bi bi-cart3"></i> Checkout</a></button>
        </div>
      </div>
    </div>
<script>
    function hapusKeranjang(id_cart){
                var token='{{csrf_token()}}';
                var my_url="{{url('/delete')}}";
                var formData= {
                    '_token' : token,
                    'id_cart' : id_cart
                };
                
                var konfirmasi = confirm("Yaaah, Serius produk pilihanmu dihapus?");

                if (konfirmasi) {
                $.ajax({
                    method:'post',
                    url: my_url,
                    data: formData,

                    success: function(resp){
                        swal("OK!", "Produknya sudah dihapus, silahkan pilih produk yang lain ya", "success");
                        location.reload();
                    
                    },

                    error: function(resp){
                        swal("Yaaah!", "Ada yang gak beres nih!", "error");
                    }
                });
            }
        }
</script>
@endsection