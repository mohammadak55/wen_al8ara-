<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $guarded  = [] ;
    public function events()
    {
        return $this->hasMany(Event::class , "Region_id") ;
    }
    public function event_details()
    {
        return $this->hasMany(Event::class , "ExactLocation_id") ;
    }
    public function general_region()
    {
        return $this->belongsTo(GeneralRegion::class , "general_region_id") ;
    }

}
