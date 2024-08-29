<?php

namespace App\Http\Controllers;

use App\Services\LocationService;

class LocationController extends Controller
{
    protected $LocationService;

    public function __construct(LocationService $LocationService)
    {
        $this->LocationService = $LocationService;
    }
    public function showLocations()
    {
        $location = $this->LocationService->getAllLocation();
        return response()->json(["location" => $location]);
    }
}
