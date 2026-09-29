<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_location extends Model
{
    protected $fillable = [
        'sale','location','calWeekNo','storeWeekNo','saleStatus'
    ];
}
