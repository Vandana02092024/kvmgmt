<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'order_by','location_id','vendor_id','order_id','quantity','price','last_updated_by'
    ];
}
