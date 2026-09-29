<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location_code', 'location','startdate', 'rank','entity_name'
    ];
}
