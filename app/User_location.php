<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_location extends Model
{
    protected $fillable = [
        'user','location'
    ];
}
