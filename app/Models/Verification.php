<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function problem(){
        return $this->belongsTo(Problem::class);
    }

    public function solution(){
        return $this->belongsTo(Solution::class);
    }

    public function verification_type(){
        return $this->belongsTo(VerificationType::class);
    }

    public function solution_function(){
        return $this->belongsTo(SolutionFunction::class);
    }

    public function verification_type_text(){
        return $this->belongsTo(VerificationTypeText::class);
    }
}
