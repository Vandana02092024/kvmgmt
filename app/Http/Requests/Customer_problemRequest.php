<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Customer_problemRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filled_date'   => 'required',
            'clerk'         => 'required',
            'customer_name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'phone1'    => 'required',
            //'cell_phone'    => 'required',
            'problem'       => 'required',
            'claim_check'   => 'required',
            'missing_date'  => 'required',
            // 'invoice_tag'   => 'required',
            // 'resolution'    => 'required',
            // 'resolved_as'   => 'required',
            // 'resolved_date' => 'required',
            // 'claim_submitted_date' => 'required',
            // 'new_location'  => 'required',
            // 'closed_date'   => 'required',
            // 'location'      => 'required',
            'assigned_to'   => 'required',
            'created_by'    => 'required'
        ];
    }
}
