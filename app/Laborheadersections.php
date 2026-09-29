<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Laborheadersections extends Model
{
    protected $fillable = [
       'location_id','start_week','end_week','start_date','end_date','total_amount'
    ];
}
