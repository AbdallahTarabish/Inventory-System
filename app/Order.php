<?php

namespace App;

use App\Models\SubStore;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    public function orderDetails(){
        return $this->hasMany(OrderDetails::class , "order_id");
    }
    public function store(){
        return $this->belongsTo(SubStore::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($val){
        if ($val === 1){
            return "قيد التنفيذ";
        }else{
            return "مكتمل";
        }
    }
}
