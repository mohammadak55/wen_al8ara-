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
        $events = $this->eventService->getAllEvents();

        return response()->json(["events" => $events]);
    }
    public function fillterEvent(Request $request)
    {
        $allowedEventTypes = ["غارة من حربي", "جدار صوت", "تحليق طيران حربي", "تحليق مسيرة", "غارة من مسيرة", "قصف مدفعي", "اغتيال", "حرائق"];
        $regions = $request->query('region');
        $eventType = $request->query('eventType');
        // Validate the eventType
        if (!empty($eventType)) {
            $validator = Validator::make(
                ['event_type' => $eventType],
                ['event_type' => ['in:' . implode(',', $allowedEventTypes)]]
            );

            if ($validator->fails()) {
                return response()->json(['error' => 'نوع الحدث غير متاح '], 422);
            }
        }
        $events = $this->eventService->fillteredEevents( $regions, $eventType);
        if ($events->isEmpty()) {
            return response()->json(['message' => 'لا يوجد احداث بمنطقة ' . $regions], 404);
        } else {
            return response()->json(["events" => $events], 200);
        }
    }

}
