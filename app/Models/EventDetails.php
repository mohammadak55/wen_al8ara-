<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
    use HasFactory;
    public function regions()
    {
        return $this->belongsTo(Region::class , "ExactLocation_id") ;
    }
    public function event()
    {
        return $this->belongsTo(Event::class , "event_id") ;
    }
}
