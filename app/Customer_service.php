<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_service extends Model
{
    protected $fillable = [
        'csr_type', 'report_id', 'claim_id', 'created_on_date', 'created_on_time','customer_name','customer_phone','customer_lastname','customer_add'
    ];
}
