<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart_detail extends Model
{
    public function produk()
	{
	      return $this->belongsTo('App\produk','produk_id', 'id');
	}

	public function all_cart()
	{
	      return $this->belongsTo('App\all_cart','cart_id', 'id');
	}
}
