<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = 'exports';

    protected $guarded = [];

    public function main_store()
    {
        return $this->belongsTo(MainStore::class, 'main_store_id');
    }

    public function sub_store()
    {
        return $this->belongsTo(SubStore::class, 'store_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
