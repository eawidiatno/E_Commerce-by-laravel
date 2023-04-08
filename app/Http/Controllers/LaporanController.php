<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function form_laporan()
    {
        //data untuk chart
        $daftar_produk = DB::table('daftar_produk')
                        ->select('*')
                        ->get();
        $itemtransaksi = DB::table('cart_details')
                        ->join('daftar_produk','daftar_produk.id','=','cart_details.produk_id')
                        ->join('all_carts','all_carts.id','=','cart_details.cart_id')
                        ->select('cart_details.*','daftar_produk.*','all_carts.status_pembayaran')
                        ->where('status_pembayaran','Sudah dibayar')
                        ->get();
            
        $categories = [];
        $data = [];

        foreach($itemtransaksi as $produk){
            $categories [] = $produk->nama_produk;
            $data [] = $produk->jumlah;
    }
        //dd($data);

        return view('Toko.Admin.form_laporan',['categories'=>$categories,'data'=>$data]);
    }

    public function proses_laporan(Request $lapor) {
        $bulan = $lapor->bulan;
        $tahun = $lapor->tahun;
        
        $itemtransaksi = DB::table('all_carts')
                    ->select('*')
                    ->whereMonth('tanggal', '=', date($bulan))
                    ->whereYear('tanggal', '=', date($tahun))
                    ->where('status_pembayaran','Sudah dibayar')
                    ->orderBy('tanggal','desc')
                    ->get();

        $data = ['itemtransaksi' => $itemtransaksi,
                'bulan' => $this->cetakbulan($bulan),
                'tahun' => $tahun
            ];
        
        return view('Toko.Admin.proses_laporan', $data);
    }
    public function cetakbulan($bulan) {
        switch ($bulan) {
            case '1':
                return "Januari";
                break;
            case '2':
                return "Februari";
                break;
            case '3':
                return "Maret";
                break;
            case '4':
                return "April";
                break;
            case '5':
                return "Mei";
                break;
            case '6':
                return "Juni";
                break;
            case '7':
                return "Juli";
                break;
            case '8':
                return "Agustus";
                break;
            case '9':
                return "September";
                break;
            case '10':
                return "Oktober";
                break;
            case '11':
                return "Nopember";
                break;
            case '12':
                return "Desember";
                break;

            default:
                return "";
                break;
        }
    }
}
