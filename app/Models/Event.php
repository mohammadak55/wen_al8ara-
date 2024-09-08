<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public function regions()
    {
        return $this->belongsTo(Region::class , "Region_id") ;
    }
    public function users()
    {
        return $this->belongsTo(User::class , "user_id") ;
    }
}
