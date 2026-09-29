<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollEmployee_department extends Model
{
    protected $fillable = [
        'payrollemp_id','payrollcat_depid','location'
    ];
}
