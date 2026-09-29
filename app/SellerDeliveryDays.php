<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerDeliveryDays extends Model
{
    protected $fillable = [
        'seller_id','location_id','delivery_day'
    ];
}
