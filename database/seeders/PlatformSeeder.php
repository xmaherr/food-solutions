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
            ['name' => 'Instagram', 'color' => '#E1306C'],
            ['name' => 'Twitter', 'color' => '#1DA1F2'],
            ['name' => 'LinkedIn', 'color' => '#0A66C2'],
            ['name' => 'Facebook', 'color' => '#1877F2'],
            ['name' => 'YouTube', 'color' => '#FF0000'],
            ['name' => 'TikTok', 'color' => '#000000'],
            ['name' => 'WhatsApp', 'color' => '#25D366'],
            ['name' => 'Snapchat', 'color' => '#FFFC00'],
        ];

        foreach ($platforms as $platform) {
            \App\Models\Platform::firstOrCreate(['name' => $platform['name']], $platform);
        }
    }
}
