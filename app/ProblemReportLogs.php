<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemReportLogs extends Model
{
    protected $fillable = [
        'problem_id','action_dt','action','user_name'
    ];
}
