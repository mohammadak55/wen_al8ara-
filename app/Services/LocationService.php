<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class LocationService
{
    public function getAllLocation()
    {
        return DB::table('regions')->select("regions.regions as location")->get();
    }
}
