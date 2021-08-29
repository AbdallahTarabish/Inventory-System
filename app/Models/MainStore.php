<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainStore extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    protected $hidden =['created_at','updated_at','deleted_at'];

    /* Start of Relations  */

    // Main Store has many categories(one(main store) to Many(categories) relation)
    public function categories(){
       return  $this->hasMany(Category::class,'main_store_id');
    }

    //Main store has Many sub store ( one(main store) to Many(sub_stores) relation)
    public function substores(){
        return $this->hasMany(SubStore::class,'main_store_id');
    }

    /*End Of Relations*/

    protected  function scopesearchName($query,$name){

        $query->when($name,function ($q) use ($name){
            return $q->where('name','like','%'.$name.'%');
        });
    }
    protected  function scopesearchStatus($query,$status){

        $query->when($status,function ($q) use ($status){
            return $q->where('status','like',$status);
        });
    }

}
