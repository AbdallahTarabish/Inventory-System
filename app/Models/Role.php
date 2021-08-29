<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    
    public $guarded = [];





    //scope--------------------------
    public function scopeWhenSearch($query,$search){
        return $query->where('name','like','%'.$search.'%');
    }

    public function scopeWhereRoleNot($query,$role_name){
        return $query->whereNotIn('name',(array)$role_name);
    }
}
