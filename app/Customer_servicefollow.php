<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_servicefollow extends Model
{
    protected $fillable = [
        'customer_service_id', 'notes','status', 'created_by', 'followup_by', 'followup_date', 'followup_time', 'followup_notes', 'mode_of_contact', 'location'
    ];
}
