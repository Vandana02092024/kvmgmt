<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track_employees extends Model
{
    protected $fillable = [
       'action','employee_detail','location','location_id','created_by'
    ];
}
