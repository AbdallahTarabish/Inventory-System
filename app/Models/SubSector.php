<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class SubSector extends Model
{
    protected $with = ['sector'];
    protected $guarded = [];


    protected function scopesearchName($query, $name)
    {

        $query->when($name, function ($q) use ($name) {
            return $q->where('name', 'like', '%' . $name . '%');
        });
    }

    protected function scopesearchSector($query, $sector_id)
    {

        $query->when($sector_id, function ($q) use ($sector_id) {
            return $q->where('sector_id', $sector_id);
        });
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function shelfs()
    {
        return $this->hasMany(Shelf::class, 'sub_sector_id');
    }

    protected function scopesearchisFilled($query, $isFilled)
    {

        $query->when($isFilled, function ($q) use ($isFilled) {
            return $q->where('isFilled', $isFilled);
        });
    }
}
