<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guitar extends Model
{
    use HasFactory;

    // this is the relationship for guitars / likes
    public function userLikes() {
        return $this->hasMany(UserLike::class);
    }

    // this is the relationship for Condition and guitars (1:M)
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    // relationship for type and guitars
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
    // prevents mass assignment error
    protected $guarded = [];
}
