<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class PayrollCategory extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','pay_rate_multiplier','sorting_order'
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
