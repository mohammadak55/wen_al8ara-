<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralRegionsSeeder extends Seeder
{
    public function run()
    {
        $generalRegions =  [
            'قطاع شرقي',
            'قطاع اوسط',
            'قطاع غربي',
            'صور',
            'الزهراني',
            'اقليم التفاح',
            'صيدا',
            'النبطية',
            'الضاحية الجنوبية',
            'بعلبك',
            'الهرمل',
            'شمسطار',
            'البقاع الغربي',
        ];

        foreach ($generalRegions as $region) {
            DB::table('general_regions')->insert([
                'general_regions' => $region,
                'created_at' => now(),
            ]);
        }
    }
}
