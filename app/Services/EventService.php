<?php
namespace App\Services;

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\DB;

class EventService
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
        if(!$check)
        {
            return ["message" => "Location not found", "status" => 404];
        }
        $event = DB::table('events')->insert([
            "event_type" => $request->event_type,
            "Region_id" => $location,
            "user_id" => $user->id,
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
            return ["message" => $notificationData["body"] , "status" => 200];
        } else {
            return ["message" => "Event creation failed", "status" => 401];
        }
    }

    public function updateEventDetail($request, $id)
    {
        $validated = $request->validate([
            "ExactLocation" => "required",
            "description" => "sometimes" ,
            "HumanCasualties" => "required|in:لا توجد إصابات بشرية,إصابات طفيفة,إصابات خطيرة,وفيات,غير معروف",
            "DamageType" => "required|in:لا توجد أضرار,أضرار طفيفة بالمباني,أضرار جسيمة بالمباني,تدمير كامل,أضرار بالمركبات,حرائق,أضرار بالبنية التحتية,غير معروف",
        ]);
        $location = DB::table("regions")->where("regions", $request->ExactLocation)->value('id');
        $check = DB::table("regions")->where("regions", $request->ExactLocation)->first();
        if(!$check)
        {
            return ["message" => "Location not found", "status" => 404];
        }
        $check = DB::table("event_details")->where("event_id" , $id)->first();
        if($check)
        {
            $event = DB::table('event_details')->update([
                "event_id" => $id,
                "ExactLocation_id" => $location,
                "description" => $request->description,
                "HumanCasualties" => $request->HumanCasualties,
                "DamageType" => $request->DamageType,
                'created_at' => now(),
            ]);
        }
        else{
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

    public function getAllEvents($page)
    {
        $pageSize = 10;
        $offset = ($page - 1) * $pageSize;
        return DB::table('events')
            ->join('regions', 'events.Region_id', '=', 'regions.id')
            ->join('general_regions', 'regions.general_region_id', '=', 'general_regions.id')
            ->select("events.id as id",'events.created_at as time', "events.event_type as event_type", 'regions.regions' , "general_regions.general_regions as general_location")
            ->orderBy('time', 'desc')
            ->skip($offset)
            ->take($pageSize)
            ->get();
    }

    public function getEventDetail($page)
    {
        $pageSize = 10;
        $offset = ($page - 1) * $pageSize;
        return DB::table("event_details")
        ->join("events" , "event_details.event_id" , "=" , "events.id")
            ->join('regions', 'event_details.ExactLocation_id', '=', 'regions.id')
            ->join('general_regions', 'regions.general_region_id', '=', 'general_regions.id')
            ->select("event_details.created_at as time", "event_details.HumanCasualties as HumanCasualties" ,"event_details.description as description", "event_details.DamageType as DamageType","events.event_type as event_type", 'regions.regions as location', "general_regions.general_regions as general_location")
            ->skip($offset)
            ->take($pageSize)
            ->orderBy('time', 'desc')
            ->get();
    }
    public function fillteredEevents($page , $regions)
    {
        $pageSize = 10;
        $offset = ($page - 1) * $pageSize;
        return DB::table('events')
            ->join('regions', 'events.Region_id', '=', 'regions.id')
            ->where('regions.regions', $regions)
            ->select("events.id as id",'events.created_at as time', "events.event_type as event_type", 'regions.regions')
            ->orderBy('time', 'desc')
            ->skip($offset)
            ->take($pageSize)
            ->get();
    }
    public function getAllLocation()
    {
        return DB::table('regions')->select("regions.regions")->get();
    }
}



