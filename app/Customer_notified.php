<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_notified extends Model
{
    protected $fillable = [
        'problem_id','customer_notified_date','by_who','comments','action'
    ];
}
