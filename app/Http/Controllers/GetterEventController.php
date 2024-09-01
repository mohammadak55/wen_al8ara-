<?php

namespace App\Http\Controllers;

use App\Services\GetterEventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function showEventDetail(Request $request , $id)
    {
        $page = $request->query('page', 1);
        $event = $this->eventService->getEventDetail($page , $id);

        return response()->json(["detail" => $event]);
    }
    public function fillterEvent(Request $request, $regions = null, $eventType = null)
    {
        $allowedEventTypes = ["غارة من حربي", "جدار صوت", "تحليق طيران حربي", "تحليق مسيرة", "غارة من مسيرة", "قصف مدفعي", "اغتيال", "حرائق"];

        // Validate the eventType
        if (!empty($eventType)) {
            $validator = Validator::make(
                ['event_type' => $eventType],
                ['event_type' => ['in:' . implode(',', $allowedEventTypes)]]
            );

            if ($validator->fails()) {
                return response()->json(['error' => 'Invalid event type.'], 422);
            }
        }
        $page = $request->query('page', 1);
        $events = $this->eventService->fillteredEevents($page, $regions, $eventType);
        if ($events->isEmpty()) {
            return response()->json(['message' => 'No event found with this region: ' . $regions], 404);
        } else {
            return response()->json(["events" => $events], 200);
        }
    }
    public function validat($event) {}
}
