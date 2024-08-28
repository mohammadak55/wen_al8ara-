<?php 
namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
        $this->messaging = $factory->createMessaging();
    }

    public function sendNotificationToTopic($topic, $title, $body)
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification($notification);

        return $this->messaging->send($message);
    }

    public function sendNotificationToDevice($deviceToken, $title, $body)
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification);

        return $this->messaging->send($message);
    }
}
