<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    // this is the relationship for guitars / conditions
    public function guitars() {
        return $this->hasMany(Guitar::class);
    }

    
    // prevents mass assignment error
    protected $guarded = [];

}
