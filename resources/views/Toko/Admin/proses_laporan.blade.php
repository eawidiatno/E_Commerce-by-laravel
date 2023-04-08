@extends('Toko.layouts.layout_admin')

@section('toko_eka')
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/form_laporan') }}">Laporan Transaksi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Hasil Laporan Transaksi</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Laporan Penjualan</h3>
        </div>
        <div class="card-body">
          <h3 class="text-center">Periode {{ $bulan != ""? "Bulan ".$bulan: "" }} {{ $tahun }}</h3>
          <br>
          <div class="row">
            <div class="col col-lg-4 col-md-4">
              <h4 class="text-center">Ringkasan Transaksi</h4>
              <!-- cetak totalnya -->
              <?php
              $total = 0;
              foreach ($itemtransaksi as $k) {
                $total += $k->total_harga;
              }
              ?>
              <!-- end cetak totalnya -->
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Total Penjualan</td>
                    <td>Rp. {{ number_format($total, 2) }}</td>
                  </tr>
                  <tr>
                    <td>Total Transaksi</td>
                    <td>{{ count($itemtransaksi) }} Transaksi</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col col-lg-8 col-md-8">
              <h4 class="text-center">Rincian Transaksi</h4>
              <div class="table-responsive">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Invoice</th>
                      <th>Tanggal</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no=1;
                    @endphp
                     @foreach($itemtransaksi as $transaksi)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>Inv-{{ $transaksi->kode }}</td>
                      <td>{{ $transaksi->tanggal }}</td>
                      <td>{{ number_format($transaksi->total_harga, 2) }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer">
              <a href="{{ url('/form_laporan') }}" class="btn btn-sm btn-danger">Tutup</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection