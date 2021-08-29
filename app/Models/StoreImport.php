<?php

namespace App\Models;

use App\StoreProduct;
use Illuminate\Database\Eloquent\Model;

class StoreImport extends Model
{
    protected $table = "store_imports";
    protected $guarded = [];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, "store_imports_id");
    }

    public function MainStore()
    {
        return $this->belongsTo(MainStore::class);
    }

    public function SubStore()
    {
        return $this->belongsTo(SubStore::class,'store_id');
    }

//        public function products(){
//        return $this->belongsToMany(Product::class , "store_products" ,"main_store_imports_id" , "product_id")
//        ->withPivot("imported_container","imported_unit","imported_package" , "product_id");
//    }

}
