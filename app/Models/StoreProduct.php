<?php

namespace App\Models;

use App\Models\StoreImport;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $table = "store_products";
    protected $fillable = ["product_id", "actual_container", "expected_container", "expected_package", "expected_unit", "store_id", "main_store_id"];

    public function scopeGetpProductInMainStore($q, $id)
    {
        return $q->where("product_id", $id)->where("main_store_id", MainStore::query()->first()->id)->get();
    }

    public function scopeGetpProductInSubStore($q, $id, $store_id)
    {
        return $q->where("product_id", $id)->Where("store_id", $store_id)->get();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function places()
    {
        return $this->hasMany(ProductPlace::class,'store_product_id');
    }
}
