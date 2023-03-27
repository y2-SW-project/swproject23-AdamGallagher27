<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // this is the relationship for users / roles
    public function users() {
        return $this->hasMany(User::class);
    }

    // prevents mass assignment error
    protected $guarded = [];


    public function authorizeRoles($roles) {
        if(is_array($roles)){
            return $this->hasAnyRole($roles) ||
            abort(401, 'this action is unauthorized');
        }
        return $this->hasRole($roles) ||
        abort(401, 'this action is unauthorized');
    }

    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
}
