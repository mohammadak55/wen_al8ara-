<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventsRequest;
use App\Models\EventDetails;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function storeEvents(Request $request)
    {
        $result = $this->eventService->createEvent($request);

        return response()->json($result['message'], $result['status']);
    }

    public function updateEventDetail(Request $request, $id)
    {
        $result = $this->eventService->updateEventDetail($request, $id);

        return response()->json($result['message'], $result['status']);
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
    public function showLocations()
    {
        $location = $this->eventService->getAllLocation();

        return response()->json(["location" => $location]);
    }
}
