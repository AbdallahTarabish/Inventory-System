<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $guarded = [];


    public function sub_sectors()
    {
        return $this->hasMany(SubSector::class, 'sector_id');
    }

    public function shelves()
    {
        return $this->hasMany(Shelf::class,'shelf_id');
    }

    protected function scopesearchName($query, $name)
    {

        $query->when($name, function ($q) use ($name) {
            return $q->where('name', 'like', '%' . $name . '%');
        });
    }

    protected function scopesearchisFilled($query, $isFilled)
    {

        $query->when($isFilled, function ($q) use ($isFilled) {
            return $q->where('isFilled', $isFilled);
        });
    }

}
