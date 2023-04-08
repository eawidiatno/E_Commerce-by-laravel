<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table='daftar_produk';
    public function cart_detail() 
	{
	     return $this->hasMany('App\cart_detail','produk_id', 'id');
	}

}

