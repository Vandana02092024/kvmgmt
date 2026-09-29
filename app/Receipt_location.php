<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt_location extends Model
{
    protected $fillable = [
        'receipt','location','calWeekNo','storeWeekNo','recStatus'
    ];
}
