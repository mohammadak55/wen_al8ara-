<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetterEventService
{
    public function getAllEvents()
    {

        $events = DB::table('events')
            ->join('regions', 'events.Region_id', '=', 'regions.id')
            ->join('general_regions', 'regions.general_region_id', '=', 'general_regions.id')
            ->select(
                'events.id as id',
                'events.subtitle as Subtitile',
                'events.created_at as time',
                'events.updated_at as updated_time',
                'events.event_type as event_type',
                'regions.regions',
                'general_regions.general_regions as general_location',
            )
            ->orderByRaw('COALESCE(updated_time,time) DESC')
            ->get();

        // Convert the created_at field to human-readable format
        $events->transform(function ($event) {
            $event->time = Carbon::parse($event->time)->diffForHumans();
            $event->updated = $event->updated_time !== null;
            $event->updated_time = $event->updated ? Carbon::parse($event->updated_time)->diffForHumans() : null;

            return $event;
        });

        return $events;
    }
    public function fillteredEevents( $regions = null, $eventType = null)
    {
        $query =  DB::table('events')
            ->join('regions', 'events.Region_id', '=', 'regions.id')
            ->join('general_regions', 'regions.general_region_id', '=', 'general_regions.id');
        if (!empty($eventType)) {
            $query->where("event_type", $eventType);
        }
        if (!empty($regions)) {
            $query->where('regions.regions', $regions);
        }

        $events = $query->select(
            'events.id as id',
            'events.subtitle as Subtitile',
            'events.created_at as time',
            'events.updated_at as updated_time',
            'events.event_type as event_type',
            'regions.regions',
            'general_regions.general_regions as general_location',
        )
            ->orderByRaw('COALESCE(updated_time,time) DESC')
            ->get();

            $events->transform(function ($event) {
                $event->time = Carbon::parse($event->time)->diffForHumans();
                $event->updated = $event->updated_time !== null;
                $event->updated_time = $event->updated ? Carbon::parse($event->updated_time)->diffForHumans() : null;

                return $event;
            });

        return $events;
    }
}
