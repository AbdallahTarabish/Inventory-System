<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPlace extends Model
{
    protected $table = "product_place";

    protected $guarded = [];

    public function storeProduct()
    {
        return $this->belongsTo(StoreProduct::class, 'store_product_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function subSector()
    {
        return $this->belongsTo(SubSector::class, 'sub_sector_id');
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }
}
