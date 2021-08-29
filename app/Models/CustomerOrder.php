<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $table = "customer_orders";

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(CustomerOrderProducts::class,'order_id');
    }
}
