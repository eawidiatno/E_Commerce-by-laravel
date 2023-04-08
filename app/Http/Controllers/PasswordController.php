<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Http\Request\UpdatePasswordRequest;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function changePassword()
    {
        return view('Toko.User.changepassword');
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $password = auth()->user()->password;
        $user_id = auth()->user()->id;

        if(Hash::check($request->input('password'),$password)){
            $user = User::find($user_id);
            $user->password = Hash::make($request->input('current_password'));
            if($user->save()){
                return redirect(url('changepassword'))->with('success', 'Change Password Success.');
            }else{
                return redirect(url('changepassword'))->with('failed', 'Password invalid.');
            }
        }else{
            return redirect(url('changepassword'))->with('failed', 'Password invalid.');
        }
    }
}
