<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class VerificationType extends Model
{
    protected $table = "verification_types";
    use HasFactory;

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    // public function verification(){
    //     return $this->hasMany(Verification::class);
    // }

    // public function verification_type_text(){
    //     return $this->hasMany(VerificationTypeText::class);
    // }


    public static function verificationTypeCategories(){
        return DB::table('verification_type_categories')->get();
    }
}
