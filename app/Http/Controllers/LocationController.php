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
        $locations = $this->LocationService->getAllLocation();
        $formattedLocations = [];
        foreach ($locations as $index => $location) {
            $formattedLocations["location" . $index] = $location->location;
        }
        return response()->json($formattedLocations);
    }
}
