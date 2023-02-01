<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationType extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function verification(){
        return $this->hasMany(Verification::class);
    }

    public function verification_type_text(){
        return $this->hasMany(VerificationTypeText::class);
    }
}
