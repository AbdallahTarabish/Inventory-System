<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $guarded=[];

    public function sector(){
        return $this->belongsTo(Sector::class,'sector_id');
    }

    public function sub_sector(){
        return $this->belongsTo(SubSector::class,'sub_sector_id');
    }

    protected  function scopesearchisFilled($query,$isFilled){

        $query->when($isFilled,function ($q) use ($isFilled){
            return $q->where('isFilled',$isFilled);
        });
    }

    protected  function scopesearchName($query,$name){

        $query->when($name,function ($q) use ($name){
            return $q->where('name','like','%'.$name.'%');
        });
    }
    protected  function scopesearchSector($query,$sector_id){

        $query->when($sector_id,function ($q) use ($sector_id){
            return $q->where('sector_id',$sector_id);
        });
    }
    protected  function scopesearchSubSector($query,$sub_sector_id){

        $query->when($sub_sector_id,function ($q) use ($sub_sector_id){
            return $q->where('sub_sector_id',$sub_sector_id);
        });
    }
}
