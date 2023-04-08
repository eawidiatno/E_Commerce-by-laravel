@extends('Toko.layouts.layout_admin')

@section('toko_eka')
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Laporan Transaksi</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col col-lg-4 col-md-4 center">
      <div class="card">
        <div class="card-header bg-info text-white">
          <h4 class="card-title">Form Laporan Transaksi</h4>
        </div>
        <div class="card-body">
          <form action="{{url('/proses_laporan')}}">
            <div class="form-group">
              <label for="bulan">Bulan</label>
              <select name="bulan" id="bulan" class="form-control">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">Nopember</option>
                <option value="12">Desember</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tahun">Tahun</label>
              <select name="tahun" id="tahun" class="form-control">
                @for($a = 2022; $a <= 2050; $a++)
                <option value="{{$a}}">{{$a}}</option>
                @endfor
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Buka Laporan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
      <div id="chart"></div>
  </div>
</div>
@endsection
@section('chart')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  Highcharts.chart('chart', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Produk Favorit'
    },
    
    xAxis: {
        categories: {!!json_encode($categories)!!} //merubah array menjadi json
    },
    yAxis: {
        title: {
            text: 'Jumlah Transaksi'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Produk',
        data: {!!json_encode($data)!!}
    }]
});
</script>
@endsection