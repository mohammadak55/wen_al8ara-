<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class GetterEventService
{
    public function getAllEvents($page)
    {
        $pageSize = 10;
        $offset = ($page - 1) * $pageSize;
        return DB::table('events')
            ->join('regions', 'events.Region_id', '=', 'regions.id')
            ->join('general_regions', 'regions.general_region_id', '=', 'general_regions.id')
            ->select("events.id as id" , "events.subtitle as Subtitile", 'events.created_at as time', "events.event_type as event_type", 'regions.regions', "general_regions.general_regions as general_location")
            ->orderBy('time', 'desc')
            ->skip($offset)
            ->take($pageSize)
            ->get();
    }

    public function getEventDetail($page)
    {
        $pageSize = 10;
        $offset = ($page - 1) * $pageSize;
        return DB::table("event_details")
            ->join("events", "event_details.event_id", "=", "events.id")
            ->join('regions', 'event_details.ExactLocation_id', '=', 'regions.id')
            ->join('general_regions', 'regions.general_region_id', '=', 'general_regions.id')
            ->select("event_details.created_at as time", "event_details.HumanCasualties as HumanCasualties", "event_details.description as description", "event_details.DamageType as DamageType", "events.event_type as event_type", 'regions.regions as location', "general_regions.general_regions as general_location")
            ->skip($offset)
            ->take($pageSize)
            ->orderBy('time', 'desc')
            ->get();
    }
    public function fillteredEevents($page, $regions)
    {
        $pageSize = 10;
        $offset = ($page - 1) * $pageSize;
        return DB::table('events')
            ->join('regions', 'events.Region_id', '=', 'regions.id')
            ->where('regions.regions', $regions)
            ->select("events.id as id", 'events.created_at as time', "events.event_type as event_type", 'regions.regions')
            ->orderBy('time', 'desc')
            ->skip($offset)
            ->take($pageSize)
            ->get();
    }
}
