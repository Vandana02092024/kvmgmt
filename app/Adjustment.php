<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Adjustment extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','sorting_order'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'name'
    ];
}
