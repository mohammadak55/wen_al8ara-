<?php

namespace App\Http\Controllers;

use App\Services\GetterEventService;
use Illuminate\Http\Request;

class GetterEventController extends Controller
{
    protected $eventService;

    public function __construct(GetterEventService $eventService)
    {
        $this->eventService = $eventService;
    }
    public function showEvents(Request $request)
    {
        $page = $request->query('page', 1);
        $events = $this->eventService->getAllEvents($page);

        return response()->json(["events" => $events]);
    }

    public function showEventDetail(Request $request)
    {
        $page = $request->query('page', 1);
        $event = $this->eventService->getEventDetail($page);

        return response()->json(["detail" => $event]);
    }
    public function fillterEvent(Request $request, $regions)
    {
        $page = $request->query('page', 1);
        $events = $this->eventService->fillteredEevents($page, $regions);
        if ($events->isEmpty()) {
            return response()->json(['message' => 'No event found with this region: ' . $regions], 404);
        } else {
            return response()->json(["events" => $events]);
        }
    }
}
