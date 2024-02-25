<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeforeAndAfter extends Model
{
    use HasFactory;
    protected $table = 'before_and_after';
    protected $fillable = [
        'problem_id', 
        'project_id',
        'solution_id',
        'solution_function_id',
        'user_id','existing_after'
    ];
}
