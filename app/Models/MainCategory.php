<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainCategory extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    public function categories(){
        return $this->hasMany(Category::class,'main_category_id');
    }

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
