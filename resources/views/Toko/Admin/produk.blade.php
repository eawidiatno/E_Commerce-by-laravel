@extends('Toko.layouts.layout_admin')

@section('toko_eka')
    @if(session('delete'))
    <div class="alert alert-danger mt-3" role="alert">
        {{session('delete')}}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{session('success')}}
    </div>
    @endif
    @if(session('update'))
    <div class="alert alert-info mt-3" role="alert">
        {{session('update')}}
    </div>
    @endif

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                          <h4 class="text-center">Daftar Produk</h4>
                      <form action="/search" class="form-inline my-1 my-lg-0 float-right" method="GET">
                        <input type="search" name="search" class="form-control mr-sm-2" placeholder="Cari Produk" aria-label="Search">
                        <button class="btn btn-outline my-2 my-sm-0 bi bi-search" type="submit"></button>
                        </form>
                      <a href="{{ url('/input_produk')}}" class="btn btn-primary">Add Produk</a>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered table-hovered" id="table">

        <thead class="bg-info">
            <tr>
                <th>No.</th>
                <th>Foto Produk</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Stock</th>
                <th>Kategori</th>
                <th>Modify</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no=1;
        ?>
        @foreach($daftar_produk as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td class="text-center">
                <img src="{{asset('/images/'.$item->foto_produk)}}" style="height:80px; width: 80px;">
            </td>
            <td>{{ $item->nama_produk}}</td>
            <td>Rp. {{number_format ($item->harga_satuan)}}</td>
            <td>{{ $item->stock}}</td>
            <td>{{ $item->kategori}}</td>
            <td class="text-center">
            <a href="{{ url('/delete_item/'.$item->id)}}"
                    onclick="return confirm('Apakah Anda ingin menghapus produk {{ $item->nama_produk }}?')"
                class="btn btn-danger"><i class="bi bi-trash"></i></a> /
                <a href="{{ url('/update_produk/'.$item->id)}}" class="btn btn-success btn-md">
                <i class="bi bi-pencil-square"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
            Showing
                {{ $daftar_produk->firstItem() }}
                to
                {{ $daftar_produk->lastItem() }}
                of
                {{ $daftar_produk->total() }}
                entries.

            <div class="float-right">
                {{ $daftar_produk->links() }}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection