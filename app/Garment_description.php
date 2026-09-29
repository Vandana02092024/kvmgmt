<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garment_description extends Model
{
    protected $fillable = [
        'problem_id','type','size','brand_name','color','material'
    ];
}
