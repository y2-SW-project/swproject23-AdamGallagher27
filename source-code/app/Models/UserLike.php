<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    use HasFactory;

    // prevents mass assignment error
    protected $guarded = [];

    protected $table = 'user_like';

    public function guitars() {
        $this->belongsToMany("App/Models/Guitar", "user_like");
    }
}
