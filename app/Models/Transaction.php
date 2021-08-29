<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ["product_id", "imported_container", "expected_container","expected_package", "expected_unit", "store_imports_id"];

    public function store_import()
    {
        return $this->belongsTo(StoreImport::class, 'store_imports_id')->with('MainStore','SubStore');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
