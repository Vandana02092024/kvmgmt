<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjustment_location extends Model
{
    protected $fillable = [
        'adjustment','location','calWeekNo','storeWeekNo','adjStatus'
    ];
}
