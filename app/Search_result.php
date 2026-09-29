<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search_result extends Model
{
    protected $fillable = [
        'problem_id','search_date','by_who','action','resolved','resolved_status'
    ];
}
