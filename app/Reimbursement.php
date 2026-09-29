<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    //
	 protected $fillable = [
        'today_date','location_id','zip_type','report_id','user_id','status','claim_check', 'claim_check_date', 'special_claim_check', 'first_name', 'last_name', 'address', 'city', 'state', 'zip_code', 'original_claim_check', 'claim_detail','compensation', 'item','email_address','telephone_number','total_desc','proof_purchase','store','store_owner_manager','receipts_attached','claim_type','damaged_desc','item_return','check_amount','credit_amount','resolution','resolution_check_pickup_mail','resolution_check','resolution_store_credit_added','resolution_store_credit_check_date','resolution_store_credit_amount','resolution_check_store_credit_pickup_mail','resolution_check_store_credit_added','resolution_check_store_credit_added_amount','resolution_check_store_credit_check','resolution_check_store_credit_check_date','resolution_check_store_credit_check_credit_number','resolution_check_store_credit_check_credit_amount','resolution_cash_paid','resolution_cash_paid_date','resolution_cash_paid_amount'
    ];
}
