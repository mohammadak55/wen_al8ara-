<?php

namespace App\Http\Controllers;

use App\Services\FCMService;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $firebaseService;

    public function __construct(FCMService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function sendNotificationToTopic($data)
    {

        $response = $this->firebaseService->sendNotificationToTopic($data);

        return response()->json($response);
    }

    public function sendNotificationToDevice(Request $request)
    {
        $deviceToken = $request->input('device_token');
        $title = $request->input('title');
        $body = $request->input('body');

        $response = $this->firebaseService->sendNotificationToDevice($deviceToken, $title, $body);

        return response()->json($response);
    }
}
