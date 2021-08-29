<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "reference_number", "category_id", "brand", "manufacturer", "supplier_id", "unit", "attachment"];

    public function costsAndprices()
    {
        return $this->hasOne(Cost::class);
    }

    public function quantity()
    {
        return $this->hasOne(Quantity::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function importedMainStore(){
        return $this->belongsTo(StoreImport::class );
    }
    public function storeProducts(){
        return $this->hasOne(StoreProduct::class);
    }

    public function mainStoreImports(){
        return $this->belongsToMany(StoreImport::class , "store_products"  , "product_id","main_store_imports_id")
            ->withPivot("imported_container","imported_unit","imported_package" , "product_id");
    }

    protected function scopeWhenSearchReferenceNumber($q, $value)
    {
        return $q->where('reference_number', 'like', '%' . $value . '%');
    }
    protected function scopeWhenSearchName($q, $value)
    {
        return $q->where('name', 'like', '%' . $value . '%');
    }
    protected function scopeWhenSearchCategory($q, $value)
    {
        return $q->where('category_id', 'like', '%' . $value . '%');
    }
    protected function scopeWhenSearchSupplier($q, $value)
    {
        return $q->where('supplier_id', 'like', '%' . $value . '%');
    }

}
