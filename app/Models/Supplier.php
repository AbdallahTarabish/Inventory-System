<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected  $guarded=[];
    public function categories(){
        return $this->belongsToMany(Category::class,'supplier_sub_categories');
    }
    protected  function scopesearchName($query,$name){

        $query->when($name,function ($q) use ($name){
            return $q->where('name','like','%'.$name.'%');
        });
    }
}
