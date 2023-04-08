<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\produk;
use App\User;
use App\cart;
use App\all_cart;
use App\cart_detail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function transaksi() //Admin
    {
        $all_transaksi = DB::table('all_carts')
                        ->select('*')
                        ->where('status','Checkout')
                        ->orderBy('id','desc')
                        ->get();

        return view('Toko.Admin.transaksi',compact('all_transaksi'));
    }

    public function data_transaksi() //Member
    {
        $user_id = Auth::user()->id;
        $cart = DB::table('all_carts')
                        ->select('*')
                        ->where('user_id',$user_id)
                        ->where('status','Checkout')
                        ->orderBy('tanggal','desc')
                        ->get();

        return view('Toko.User.data_transaksi',compact('cart'));
    }

    public function detile($id) //Member
    {
        $all_cart = DB::table('all_carts')
                    ->select('*')
                    ->where('status','Checkout')
                    ->where('id', $id)
                    ->first();

        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->get();
        
        $user_id = Auth::user()->id;

        $cart_details = DB::table('cart_details')
                        ->join('daftar_produk','daftar_produk.id','=','cart_details.produk_id')
                        ->join('all_carts','all_carts.id','=','cart_details.cart_id')
                        ->select('cart_details.*','daftar_produk.*','all_carts.status')
                        ->where('cart_details.user_id',$user_id)
                        ->where('cart_id',$id)
                        ->where('status','Checkout')
                        ->get();
    	

     	return view('Toko.User.detile', compact('all_cart','cart_details'));
    }

    public function bukti_bayar($id) //Member
    {
        $cart = DB::table('all_carts')
                ->select('*')
                ->where('id', $id)
                ->first();

        return view('Toko.User.bukti_bayar', compact('cart'));
    }

    public function save_bukti(Request $save, $id) //Member
    {
        $buktiBayar = $save->file('bukti_bayar');

        $namaFoto = uniqid('bukti_bayar');
        $extension = $buktiBayar->getClientOriginalExtension();
        $fileFoto = $namaFoto . "." . $extension;

        $tujuanUpload = public_path(). '/images/';
        $buktiBayar->move($tujuanUpload, $fileFoto);

        $user_id = Auth::user()->id;
        $id = $save->id;

        $saveBukti = [
            'bukti_bayar' => $fileFoto
        ];

        DB::table('all_carts')
        ->where('id',$id)
        ->where('user_id',$user_id)
        ->update($saveBukti);

        return redirect(url('data_transaksi'))->with('success', 'Bukti Bayar berhasil diupload!');
    }

    public function update_transaksi($id) //Admin
    {
        $all_cart = DB::table('all_carts')
                    ->leftjoin('users', 'all_carts.user_id','users.id')
                    ->select('users.*','all_carts.*')
                    ->where('status','Checkout')
                    ->where('all_carts.id', $id)
                    ->first();
                    
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->get();

        $all_transaksi = DB::table('cart_details')
                        ->join('daftar_produk','daftar_produk.id','=','cart_details.produk_id')
                        ->select('cart_details.*','daftar_produk.*')
                        ->where('cart_details.cart_id',$id)
                        ->get();

        return view('Toko.Admin.update_transaksi',compact('all_cart','all_transaksi'));
    }
    public function save_update_transaksi(Request $simpan) //Admin
    {
        $statusPembayaran = $simpan->status_pembayaran;
        $statusPengiriman = $simpan->status_pengiriman;

        $id = $simpan->id;

        $updateData = [
            'status_pembayaran' => $statusPembayaran,
            'status_pengiriman' => $statusPengiriman
        ];

        DB::table('all_carts')
        ->where('id',$id)
        ->update($updateData);

        return redirect(url('transaksi'))->with('success', 'Order berhasil diupdate!');
    }
    
}
