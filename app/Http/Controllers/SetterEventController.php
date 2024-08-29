<?php

namespace App\Http\Controllers;

use App\Services\SetterEventService;
use Illuminate\Http\Request;

class SetterEventController extends Controller
{
    protected $eventService;

    public function __construct(SetterEventService $eventService)
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
}
