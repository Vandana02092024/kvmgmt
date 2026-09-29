<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Customer_serviceRequest extends Request
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
            'csr_type'   => 'required',
            // 'created_on_date'         => 'required',
            // 'created_on_time' => 'required',
            // 'created_by' => 'required',
          //  'followup_by'    => 'required',
           // 'followup_date'       => 'required',
           // 'followup_time'   => 'required',
          //  'mode_of_contact'  => 'required',
        ];
    }
}
