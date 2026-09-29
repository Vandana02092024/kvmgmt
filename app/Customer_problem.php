<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_problem extends Model
{
    protected $fillable = [
			'filled_date','clerk','customer_name','customer_last_name','home_phone','work_phone','cell_phone',
			'address','city','state','zip','phone2','phone1',
			'problem','claim_check','claim_check_val','missing_date','invoice_tag','tag_no','resolution','resolved_as','other_problem',
			'resolved_date','claim_submitted_date','new_location','closed_date','status',
			'location','assigned_to','created_by'
		];
}
