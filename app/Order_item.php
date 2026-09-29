<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $fillable = [
        'order_id','product','product_name','code','category','unit','quantity','actual_price','price'
    ];
}
