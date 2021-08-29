<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportTransaction extends Model
{
    protected $table = 'export_transactions';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function export()
    {
        return $this->belongsTo(Export::class,'export_id');
    }
}
