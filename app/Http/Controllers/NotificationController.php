<?php
namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function sendNotificationToTopic(Request $request)
    {
        $topic = $request->input('topic');
        $title = $request->input('title');
        $body = $request->input('body');

        $response = $this->firebaseService->sendNotificationToTopic($topic, $title, $body);

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
