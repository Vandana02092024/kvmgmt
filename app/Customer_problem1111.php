<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_problem extends Model
{
    protected $fillable = [
			'filled_date','clerk','customer_name','customer_last_name','home_phone','work_phone','cell_phone',
			'address','city','state','zip',
			'problem','claim_check','claim_check_val','missing_date','invoice_tag','tag_no','resolution','resolved_as',
			'resolved_date','claim_submitted_date','new_location','closed_date',
			'location','assigned_to','created_by'
		];
}
