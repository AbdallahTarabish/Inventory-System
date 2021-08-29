<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubStore extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    /* Start of Relations  */

    // Sub store has many categories(many to many relation)
    public function categories(){
        return $this->belongsToMany(Category::class,'sub_category_store');
    }

    //  sub store belongs to Main Store (many(sub stores) to one(main store) relation)
    public function mainstore()
    {
        return $this->belongsTo(MainStore::class,'main_store_id');
    }
    /* End of Relations  */

    /* Start search Methods*/

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
    /* End search Methods*/
}
