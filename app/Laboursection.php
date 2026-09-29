<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Laboursection extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'header_id','empId','catId','depId','weekNo','rate' // ,'location_id','start_week','end_week'
    ];

   
}
