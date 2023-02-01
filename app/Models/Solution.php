<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function problem(){
        return $this->belongsTo(Problem::class);
    }

    public function solutionType(){
        return $this->belongsTo(SolutionType::class);
    }

    public function solFunction(){
        return $this->hasMany(SolutionFunction::class);
    }

    public function verification(){
        return $this->hasMany(Verification::class);
    }
}
