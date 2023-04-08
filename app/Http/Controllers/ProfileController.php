<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
    	$user = User::where('id', Auth::user()->id)->first();

    	return view('Toko.User.profile', compact('user'));
    }

    public function update(Request $request)
    {
    	 $this->validate($request, [
            'password'  => 'confirmed',
        ]);

    	$user = User::where('id', Auth::user()->id)->first();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->nohp = $request->nohp;
    	$user->alamat = $request->alamat;
		$user->provinsi = $request->provinsi;
		$user->kota_kabupaten = $request->kota_kabupaten;
		$user->kecamatan = $request->kecamatan;
		$user->kelurahan = $request->kelurahan;
		$user->kode_pos = $request->kode_pos;
    	if(!empty($request->password))
    	{
    		$user->password = Hash::make($request->password); //copas dari register
    	}
    	
    	$user->update();

    	return redirect('profile')->with('profile','Profile berhasil diupdate');
    }
}
