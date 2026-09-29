<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    protected $fillable = [
        'cart_id','product','product_name','code','category','unit','quantity','actual_price','price'
    ];
}
