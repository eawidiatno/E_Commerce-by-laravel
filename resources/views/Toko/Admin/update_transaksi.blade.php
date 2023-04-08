@extends('Toko.layouts.layout_admin')

@section('toko_eka')
<div class="container">
<nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/transaksi') }}">Order List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Order</li>
                </ol>
            </nav>
  <div class="row">
    <div class="col col-lg-8 col-md-8 mb-2">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Item</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no=1;
                @endphp
                @foreach($all_transaksi as $d)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{ $d->nama_produk }}</td>
                    <td>{{ number_format($d->harga_satuan) }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>{{ number_format($d->total_harga) }}</td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="4">
                    <b>Total</b>
                  </td>
                  <td>
                    <b>
                    {{ number_format($all_cart->total_harga) }}
                    </b>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <a href="{{ url('/transaksi') }}" class="btn btn-sm btn-danger">Tutup</a>
        </div>
      </div>
      <div class="card">
        <div class="card-header">Alamat Pengiriman</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-stripped">
              <thead>
                <tr>
                  <th>Nama Penerima</th>
                  <th>Alamat</th>
                  <th>No tlp</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    {{ $all_cart->name }}
                  </td>
                  <td>
                    {{ $all_cart->alamat }}<br />
                    {{ $all_cart->kelurahan}}, {{ $all_cart->kecamatan}}<br />
                    {{ $all_cart->kota_kabupaten}}, {{ $all_cart->provinsi}} - {{ $all_cart->kode_pos}}
                  </td>
                  <td>
                    {{ $all_cart->nohp }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col col-lg-4 col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ringkasan</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <form action="{{url('/save_update_transaksi')}}" method='post'>
              @csrf
              <tbody>
                <tr>
                  <td>
                    Total
                  </td>
                  <td>
                    <input type="text" name="total_harga" id="total_harga" class="form-control" value="{{ number_format($all_cart->total_harga) }}">
                  </td>
                </tr>
                <tr>
                  <td>Status Pembayaran</td>
                  <td>
                    <?php
                    if($all_cart->status_pembayaran == 'Sudah dibayar'){
                      echo"<select name='status_pembayaran' id='status_pembayaran' class='form-control'>;
                      <option id='Sudah dibayar' value='Sudah dibayar' {{ $all_cart->status_pembayaran == 'Sudah dibayar' ? 'selected':'' }}>Sudah dibayar</option>
                      <option disabled='disabled' id='Belum dibayar' value='Belum dibayar' {{ $all_cart->status_pembayaran == 'Belum dibayar' ? 'selected':'' }}>Belum dibayar</option>
                    </select>";
                    }else{
                    echo "<select name='status_pembayaran' id='status_pembayaran' class='form-control'>;
                      <option id='Sudah dibayar' value='Sudah dibayar' {{ $all_cart->status_pembayaran == 'Sudah dibayar' ? 'selected':'' }}>Sudah dibayar</option>
                      <option id='Belum dibayar' value='Belum dibayar' {{ $all_cart->status_pembayaran == 'Belum dibayar' ? 'selected':'' }}>Belum dibayar</option>
                    </select>";}
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Status Pengiriman</td>
                  <td>
                    <select name="status_pengiriman" id="status_pengiriman" class="form-control">
                      <option value="Dikirim" {{ $all_cart->status_pengiriman == 'Dikirim' ? 'selected':'' }}>Dikirim</option>
                      <option value="Dikemas" {{ $all_cart->status_pengiriman == 'Dikemas' ? 'selected':'' }}>Dikemas</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                  </td>
                  <td>
                  <input type="text" value="{{$all_cart->id}}" name="id" hidden="">
                  <button type="submit" class="btn btn-primary">Update</button>
                  </td>
                </tr>
              </tbody>
              </form>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("status_pembayaran").onchange = function () {
    if($all_cart->status_pengiriman== 'Sudah dibayar'){
      document.getElementById("Belum dibayar").setAttribute("disabled", "disabled");
    }else{
      document.getElementById("Belum dibayar").removeAttribute("disabled");;
    }
  };
</script>
@endsection