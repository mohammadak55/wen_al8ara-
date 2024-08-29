<?php

namespace App\Services;

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\DB;

class SetterEventService
{
    public function createEvent($request)
    {
        $user =  $request->user();
        $val = $request->validate(
            [
                "event_type" => "required|in:غارة من حربي,جدار صوت,تحليق طيران حربي,تحليق مسيرة,غارة من مسيرة,قصف مدفعي,اغتيال,حرائق",
                "regions" => "required"
            ],
        );
        $location = DB::table("regions")->where("regions", $request->regions)->value('id');
        $check = DB::table("regions")->where("regions", $request->regions)->first();
        if (!$check) {
            return ["message" => "Location not found", "status" => 404];
        }
        $messages = [
            "حرائق" => " أدت الغارات الإسرائيلية إلى اندلاع حرائق واسعة في منطقة $check->regions",
            "اغتيال" => "نفذت القوات الإسرائيلية عملية إغتيال في منطقة $check->regions.",
            "قصف مدفعي" => "تعرضت منطقة $check->regions لقصف مدفعي من قبل القوات الإسرائيلية.",
            "غارة من مسيرة" => "نفذت طائرة مسيرة إسرائيلية غارة على موقع في $check->regions.",
            "تحليق مسيرة" => "رصدت مسيرات إسرائيلية تحلق فوق المناطق الحدودية.",
            "تحليق طيران حربي" => "شهدت سماء لبنان تحليقاً مكثفاً للطيران الحربي الإسرائيلي.",
            "جدار صوت" => "أحدث الطيران الحربي الإسرائيلي جدار صوتي فوق سماء الجنوب اللبناني.",
            "غارة من حربي" => "قام العدو الإسرائيلي بالإغارة على منطقة $check->regions."
        ];

        $message = $messages[$request->event_type] ;

        $event = DB::table('events')->insert([
            "event_type" => $request->event_type,
            "Region_id" => $location,
            "user_id" => $user->id,
            "subtitle" => $message ,
            'created_at' => now(),
        ]);
        $time = now()->format('H:i:s');
        $notificationData = [
            'title' => 'New event Posted',
            'body' => "حدث الآن في الساعة {$time} $request->event_type , منطقة : {$request->regions}",
            'topic' => 'news',
        ];
        app(NotificationController::class)->sendNotificationToTopic($notificationData);
        if ($event) {
            return ["message" => $notificationData["body"], "status" => 200];
        } else {
            return ["message" => "Event creation failed", "status" => 401];
        }
    }

    public function updateEventDetail($request, $id)
    {
        $validated = $request->validate([
            "ExactLocation" => "required",
            "description" => "sometimes",
            "HumanCasualties" => "required|in:لا توجد إصابات بشرية,إصابات طفيفة,إصابات خطيرة,وفيات,غير معروف",
            "DamageType" => "required|in:لا توجد أضرار,أضرار طفيفة بالمباني,أضرار جسيمة بالمباني,تدمير كامل,أضرار بالمركبات,حرائق,أضرار بالبنية التحتية,غير معروف",
        ]);
        $location = DB::table("regions")->where("regions", $request->ExactLocation)->value('id');
        $check = DB::table("regions")->where("regions", $request->ExactLocation)->first();
        if (!$check) {
            return ["message" => "Location not found", "status" => 404];
        }
        $check = DB::table("event_details")->where("event_id", $id)->first();
        if ($check) {
            $event = DB::table('event_details')->update([
                "event_id" => $id,
                "ExactLocation_id" => $location,
                "description" => $request->description,
                "HumanCasualties" => $request->HumanCasualties,
                "DamageType" => $request->DamageType,
                'created_at' => now(),
            ]);
        } else {
            $event = DB::table('event_details')->insert([
                "event_id" => $id,
                "ExactLocation_id" => $location,
                "description" => $request->description,
                "HumanCasualties" => $request->HumanCasualties,
                "DamageType" => $request->DamageType,
                'created_at' => now(),
            ]);
        }

        DB::table("events")->where("id", $id)->update([
            "Region_id" => $location,
        ]);

        if ($event) {
            return ["message" => "Event posted successfully", "status" => 200];
        } else {
            return ["message" => "Event posting failed", "status" => 401];
        }
    }
}
