<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    protected $fillable=["max_container" , "max_package"  , "max_unit"  , "product_id"];
}
