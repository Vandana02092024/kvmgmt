<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount_location extends Model
{
    protected $fillable = [
        'discount','location','calWeekNo','storeWeekNo','disStatus'
    ];
}
