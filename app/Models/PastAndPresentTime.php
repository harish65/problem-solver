<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastAndPresentTime extends Model
{
    use HasFactory;
    protected $table = 'past_and_present_time';
    protected $fillable = [
        'problem_id', 
        'project_id',
        'solution_id',
        'solution_function_id',
        'user_id','existing_after','verffiation_type_id','time','solution_hold'
    ];
}
