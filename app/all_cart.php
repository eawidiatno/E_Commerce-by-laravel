<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class all_cart extends Model
{
    public function user()
	{
	      return $this->belongsTo('App\User','user_id', 'id');
	}

	public function cart_detail() 
	{
	     return $this->hasMany('App\cart_detail','cart_id', 'id');
	}
}
