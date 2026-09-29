<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_service extends Model
{
    protected $fillable = [
        'csr_type', 'report_id', 'claim_id', 'created_on_date', 'created_on_time', 'notes', 'created_by', 'followup_by', 'followup_date', 'followup_time', 'followup_notes', 'mode_of_contact', 'location'
    ];
}
