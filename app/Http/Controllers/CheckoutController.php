<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\User;
use App\cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout($id)
    {
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->get();
    	$user_id = Auth::user()->id;
        $all_transaksi = DB::table('cart')
                        ->join('daftar_produk','daftar_produk.id','=','cart.produk_id')
                        ->join('users', 'cart.user_id','users.id')
                        ->select('users.*','cart.*','daftar_produk.*')
                        ->where('id_cart',$id)
                        ->where('user_id',$user_id)
                        ->where('status','Checkout')
                        ->get();

        return view ('Toko.User.detile',compact('daftar_produk','users','all_transaksi'));
    }
}
