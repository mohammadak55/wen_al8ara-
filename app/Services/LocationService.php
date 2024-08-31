<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class LocationService
{
    public function getAllLocation()
    {
        return DB::table('regions')->pluck("regions");
    }
}
