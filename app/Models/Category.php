<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    public function main(){
        return $this->belongsTo(MainCategory::class,'main_category_id');
    }
    public function main_store(){
        return $this->belongsTo(MainStore::class,'main_store_id');
    }

    public function sub_store(){
        return $this->belongsToMany(SubStore::class,'sub_category_store');
    }
    public function suppliers(){
        return $this->belongsToMany(Supplier::class,'supplier_sub_categories' , "category_id" , "supplier_id")
            ->withPivot("category_id" , "supplier_id");
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
    protected  function scopesearch_main_category($query,$search_main){

        $query->when($search_main,function ($q) use ($search_main){
            return $q->whereHas('main',function ($qq)use ($search_main){
               return $qq->where('id',$search_main);
            });
        });
    }

}
