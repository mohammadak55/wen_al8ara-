<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        $userId = 1; // Replace with the ID of the user you want to associate the events with
        $regionId = 25; // Replace with the ID of the region you want to associate the events with
        $eventTypes = ["غارة من حربي", "جدار صوت", "تحليق طيران حربي", "تحليق مسيرة", "غارة من مسيرة", "قصف مدفعي", "اغتيال", "حرائق"];

        $events = [];
        for ($i = 0; $i < 20000; $i++) {
            $events[] = [
                'event_type' => $eventTypes[array_rand($eventTypes)],
                'Region_id' => $regionId,
                'user_id' => $userId,
            ];
        }

        DB::table('events')->insert($events);
    }
}
