<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function input_produk(){
        return view('Toko.Admin.input_produk');
    }
    public function simpan_produk(Request $simpan){
        $namaProduk = $simpan->nama_produk;
        $hargaSatuan = $simpan->harga_satuan;
        $stock = $simpan->stock;
        $kategori = $simpan->kategori;
        $fotoProduk = $simpan->file('foto_produk');

        $namaFoto = uniqid('foto_produk');
        $extension = $fotoProduk->getClientOriginalExtension();
        $fileFoto = $namaFoto . "." . $extension;

        $tujuanUpload = public_path(). '/images/';
        $fotoProduk->move($tujuanUpload, $fileFoto);

        $simpanProduk = [
            'nama_produk' => $namaProduk,
            'harga_satuan' => $hargaSatuan,
            'stock' => $stock,
            'kategori' => $kategori,
            'foto_produk' => $fileFoto
        ];
        DB::table('daftar_produk')
        ->insert($simpanProduk);

        return redirect(url('produk'))->with('success', 'Produk berhasil ditambahkan!');
    }
    public function produk(){
        $daftar_produk = DB::table('daftar_produk')
        ->select('*')
        ->paginate(5);

        return view ('Toko.Admin.produk', compact('daftar_produk'));
    }
    public function delete_item($id){
        DB::table('daftar_produk')
        ->where('id', $id)
        ->delete();

        return redirect(url('/produk'))->with('delete', 'Produk berhasil dihapus!');
    }
    public function update_produk($id){
        $daftar_produk = DB::table('daftar_produk')
        ->select('*')
        ->where('id', $id)
        ->first();

        return view ('Toko.Admin.update_produk', compact('daftar_produk'));
    }
    public function simpan_update_produk(Request $simpan){
        $namaProduk = $simpan->nama_produk;
        $hargaSatuan = $simpan->harga_satuan;
        $stock = $simpan->stock;
        $kategori = $simpan->kategori;
        $fotoProduk = $simpan->file('foto_produk');

        $namaFoto = uniqid('foto_produk');
        $extension = $fotoProduk->getClientOriginalExtension();
        $fileFoto = $namaFoto . "." . $extension;

        $tujuanUpload = public_path(). '/images/';
        $fotoProduk->move($tujuanUpload, $fileFoto);

        $id = $simpan->id;

        $updateData = [
            'nama_produk' => $namaProduk,
            'harga_satuan' => $hargaSatuan,
            'stock' => $stock,
            'kategori' => $kategori,
            'foto_produk' => $fileFoto
        ];

        DB::table('daftar_produk')
        ->where('id', $id)
        ->update($updateData);

        return redirect(url('produk'))->with('update', 'Produk berhasil diUpdate!');
    }
    public function search(Request $request){
        if($request->has('search')){
            $daftar_produk = DB::table('daftar_produk')
            ->select('*')
            ->where('nama_produk','like','%' . $request->search .'%')
            ->paginate(5);
        }else{
            $daftar_produk = DB::table('daftar_produk')
            ->paginate(3);
        }
        dd($request);
        return view ('Toko.Admin.produk', compact('daftar_produk'));
    }
}