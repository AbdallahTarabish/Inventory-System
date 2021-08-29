<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
    use SoftDeletes;
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function getAllPermissions()
    {
        $permissions = [];

        foreach($this->roles as $role) {
            foreach($role->permissions as $permission) {
                $permissions[] = $permission->name;
            }
        }

        return array_unique($permissions);
    }
    protected $fillable = [
        'name', 'email', 'password','mobile','main_store_id','sub_store_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /* Relations */
    public function main_store()
    {
        return $this->belongsTo(MainStore::class,'main_store_id');
    }

    public function sub_store()
    {
        return $this->belongsTo(SubStore::class,'sub_store_id');
    }



    //scope--------------------------
    public function scopeWhenSearch($query,$search){
        return $query->where('name','like','%'.$search.'%');
    }

    public function scopeWhenRole($query,$role_id){
        return $query->when($role_id,function ($q) use ($role_id){
            return $this->scopeWhereRole($q,$role_id);
        });
    }

    public function scopeWhereRole($query,$role_id){

        return $query->whereHas('roles', function ($q) use($role_id){
            return $q->whereIn('id',(array)$role_id);
        });
    }

    public function scopeWhereRoleNot($query,$role_name){

        return $query->whereHas('roles', function ($q) use($role_name){
            return $q->whereNotIn('name',(array)$role_name);
        });
    }
}
