<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'order_date',
        'quantity',
        'price',
        'order_by',
        'vendor',
        'vendor_name',
        'vendor_phone',
        'vendor_email',
        'vendor_address',
        'location',
        'status',
		'comments',
        'created_by',
        'last_updated_by'
    ];
}
