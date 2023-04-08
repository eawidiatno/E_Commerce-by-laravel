<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\produk;
use App\User;
use App\cart;
use App\all_cart;
use App\cart_detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detile_produk($id){ //menampilkan barang dari database berdasarkan ID
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->where('id', $id)
                        ->first();
        return view('Toko.User.detile_produk',compact('daftar_produk'));
    }

    public function cart_detail() // membuat daftar produk di cart (Opsi Menggunakan 2 DB)
    {
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->get();
        $user_id = Auth::user()->id;
        $shopping_cart = DB::table('cart_details')
                        ->join('daftar_produk','cart_details.produk_id','=','daftar_produk.id')
                        ->join('all_carts', 'cart_details.cart_id','=','all_carts.id')
                        ->select('cart_details.*','daftar_produk.*','all_carts.status')
                        ->where('cart_details.user_id',$user_id)
                        ->where('status','cart')
                        ->get();

        return view('Toko.User.cart',compact('daftar_produk','shopping_cart'));
    }

    public function save_cartid(Request $request, $id)//menambahkan ke database cart (Opsi Menggunakan 2 DB)
    {
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->where('id', $id)
                        ->first();
        $tanggal = Carbon::now();

        //validasi apakah jumlah order melebihi stok
    	if($request->jumlah > $daftar_produk->stock)
    	{
    		return redirect('detile_produk/'.$id)->with('stock', 'Stock tidak mencukupi!');
    	}

        //cek validasi cart
        $cek_cart = all_cart::where('user_id', Auth::user()->id)->where('status','cart')->first();

        //Save to database all_cart
        if(empty($cek_cart)){
            $all_cart = new all_cart;
            $all_cart->user_id = Auth::user()->id;
            $all_cart->tanggal = $tanggal;
            $all_cart->status = 'cart';
            $all_cart->status_pembayaran = "Proses Pengecekan";
            $all_cart->status_pengiriman = "Checkout";
            $all_cart->kode = mt_rand(100, 999);
            $all_cart->jumlah = 0;
            $all_cart->total_harga = 0;
            $all_cart->save();
        }
        
        //Save to database cart_detail
        $cart_new = all_cart::where('user_id',Auth::user()->id)->where('status','cart')->first(); //untuk membuat cart_id

        //cek cart_detail agar tidak double order dalam 1 user
        $cek_cart_detail = Cart_detail::where('produk_id', $daftar_produk->id)->where('cart_id', $cart_new->id)->first();
        if(empty($cek_cart_detail)){
            $cart_detail = new Cart_detail;
            $cart_detail->user_id = Auth::user()->id;
            $cart_detail->produk_id = $daftar_produk->id;
            $cart_detail->cart_id = $cart_new->id;
            $cart_detail->jumlah = $request->jumlah;
            $cart_detail->total_harga = $daftar_produk->harga_satuan*$request->jumlah;
            $cart_detail->save();
        }else{
            $cart_detail = cart_detail::where('produk_id', $daftar_produk->id)->where('cart_id', $cart_new->id)->first();
            $cart_detail->jumlah = $cart_detail->jumlah+$request->jumlah; //yang sudah ada di tambahkan yg baru
            $harga_cart_detail_new = $daftar_produk->harga_satuan*$request->jumlah; //var baru untuk total harga item baru
            $cart_detail->total_harga = $cart_detail->total_harga+$harga_cart_detail_new;
            $cart_detail->update();
        }
    
        //jumlah total
        $all_cart = all_cart::where('user_id', Auth::user()->id)->where('status','cart')->first();
        $all_cart->total_harga = $all_cart->total_harga+$daftar_produk->harga_satuan*$request->jumlah;
        $all_cart->jumlah = $all_cart->jumlah+$request->jumlah;
        $all_cart->update();

        return redirect(('home'));
    }

    public function delete(Request $id) //(Opsi Menggunakan 2 DB)
    {
        $id_cart = $id->id_cart;
        $cart_detail = DB::table('cart_details')
                        ->select('*')
                        ->where('id_cart',$id_cart)
                        ->first();

        $all_cart = DB::table('all_carts')
                        ->select('*')
                        ->where('id', $cart_detail->cart_id)
                        ->first();

        $total_harga = $all_cart->total_harga-$cart_detail->total_harga;
        $jumlah = $all_cart->jumlah-$cart_detail->jumlah;
        $update_data=[
            'total_harga' => $total_harga,
            'jumlah' => $jumlah
        ];
        DB::table('all_carts')
                ->update($update_data);
        
        DB::table('cart_details')
            ->where('id_cart',$id_cart)
            ->delete();
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->alamat))
        {
            return redirect('profile')->with('Identitas','Identitasi Harap dilengkapi');
        }

        if(empty($user->nohp))
        {
            return redirect('profile')->with('Identitas','Identitasi Harap dilengkapi');
        }

        $all_cart = all_cart::where('user_id', Auth::user()->id)->where('status','cart')->first();
        $user_id = Auth::user()->id;
        $cart_id = $all_cart->id;
        $status = 'Checkout';
        $update_status=[
            'status' => $status,
        ];
        DB::table('all_carts')
            ->where('user_id', $user_id)
            ->update($update_status);

        $cart_details = cart_detail::where('cart_id', $cart_id)->get();
        foreach ($cart_details as $carts) {
            $produk = produk::where('id', $carts->produk_id)->first();
            $stock = $produk->stock-$carts->jumlah;
            $data=[
                'stock' => $stock,
                ];
                DB::table('daftar_produk')
                    ->where('id', $produk->id)
                    ->update($data);

            }        
            return redirect('data_transaksi/'.$cart_id);
    }


    


    

    public function cart() // membuat daftar produk di cart
    {
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->get();
        $user_id = Auth::user()->id;
        $shopping_cart = DB::table('cart')
                        ->leftjoin('daftar_produk','cart.produk_id','daftar_produk.id')
                        ->select('cart.*','daftar_produk.*')
                        ->where('status','cart')
                        ->where('user_id',$user_id)
                        ->get();

        return view('Toko.User.cart',compact('daftar_produk','shopping_cart'));
    }

    public function save_cart(Request $belanja, $id)//menambahkan ke database cart
    {   
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->where('id', $id)
                        ->first();
        //validasi apakah jumlah order melebihi stok
    	if($belanja->jumlah > $daftar_produk->stock)
    	{
    		return redirect('detile_produk/'.$id)->with('stock', 'Stock tidak mencukupi!');
    	}

        //cek cart_checkouts agar tidak double order dalam 1 user
        $cek_cart = cart::where('produk_id', $daftar_produk->id)->where('user_id',Auth::user()->id)->first();
        if(empty($cek_cart)){
            $user_id = $belanja->user_id;
            $produk_id = $belanja->produk_id;
            $harga_satuan = $belanja->harga_satuan;
            $jumlah = $belanja->jumlah;
            $kode = mt_rand(100,999);
            $status = "cart";
            $status_pembayaran = "Proses Pengecekan";
            $status_pengiriman = "Checkout";
            $tanggal = Carbon::now();

            $data_insert=[
                'user_id' => $user_id,
                'produk_id' => $produk_id,
                'harga_satuan' => $harga_satuan,
                'jumlah' => $jumlah,
                'total_harga' => $harga_satuan*$jumlah,
                'kode' => $kode,
                'status' => $status,
                'tanggal' => $tanggal,
                'status_pembayaran' => $status_pembayaran,
                'status_pengiriman' => $status_pengiriman
            ];
            DB::table('cart')
                ->insert($data_insert);
        }else{
            $cek_cart = cart::where('produk_id', $daftar_produk->id)->where('user_id',Auth::user()->id)->first();
            $jumlah = $cek_cart->jumlah+$belanja->jumlah;
            $harga_satuan = $belanja->harga_satuan;

            $update_data=[
                'jumlah' => $jumlah,
                'total_harga' => $harga_satuan*$jumlah,
            ];
            DB::table('cart')
                ->where('status','cart')
                ->where('produk_id', $daftar_produk->id)
                ->where('user_id',Auth::user()->id)
                ->update($update_data);
        }
            
            return redirect(('home'));

    }
    
    public function delete_cart(Request $hapus) //menghapus data di cart
    {
        $id_cart = $hapus->id_cart;
        DB::table('cart')
            ->where('id_cart',$id_cart)
            ->delete();
    }
    
}
