<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrderProducts extends Model
{
    protected $table = 'order_products';

    protected $guarded = [];


    public function Order()
    {
        return $this->belongsTo(CustomerOrder::class, 'order_id');
    }
}
