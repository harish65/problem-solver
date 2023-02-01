<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Problem;

class Project extends Model
{
    use HasFactory;
    public function problem()
    {
        return $this->hasOne(Problem::class);
    }
}
