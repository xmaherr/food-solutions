<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            ['name_ar' => 'انستغرام',  'name_en' => 'Instagram',  'color' => '#E1306C'],
            ['name_ar' => 'تويتر',     'name_en' => 'Twitter',    'color' => '#1DA1F2'],
            ['name_ar' => 'لينكد إن',  'name_en' => 'LinkedIn',   'color' => '#0A66C2'],
            ['name_ar' => 'فيسبوك',    'name_en' => 'Facebook',   'color' => '#1877F2'],
            ['name_ar' => 'يوتيوب',    'name_en' => 'YouTube',    'color' => '#FF0000'],
            ['name_ar' => 'تيك توك',   'name_en' => 'TikTok',     'color' => '#000000'],
            ['name_ar' => 'واتساب',    'name_en' => 'WhatsApp',   'color' => '#25D366'],
            ['name_ar' => 'سناب شات',  'name_en' => 'Snapchat',   'color' => '#FFFC00'],
        ];

        foreach ($platforms as $platform) {
            \App\Models\Platform::firstOrCreate(
                ['name_en' => $platform['name_en']],
                $platform
            );
        }
    }
}
