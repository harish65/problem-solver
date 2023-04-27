<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationEntity extends Model
{
    use HasFactory;
    protected $fillable = [
        'verification_key', 
        'verification_value',
        'verId',
        'verTypeId',
        'created_at'
    ];
}
