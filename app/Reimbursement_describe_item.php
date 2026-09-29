<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reimbursement_describe_item extends Model
{
    //
	 protected $fillable = [
        'reimburse_id', 'item_desc', 'material', 'color', 'date_purchase', 'amount_paid', 'purchase_location'
    ];
}
