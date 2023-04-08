<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'cart';

//    public function user()
//{
//  return $this->belongsTo('App\User','user_id', 'id');
//}public function cart_checkout()
//{
//  return $this->hasMany('App\cart_checkout','cart_id','id');
//}
}
