<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BilingualTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_arabic_when_requested()
    {
        // Create a service
        $service = Service::create([
            'title_ar' => 'خدمة تجريبية',
            'title_en' => 'Test Service',
            'short_description_ar' => 'وصف قصير',
            'short_description_en' => 'Short description',
            'long_description_ar' => 'وصف طويل للخدمة',
            'long_description_en' => 'Long description of service',
            'icon' => 'test-icon.png',
            'image' => 'test-image.png',
            'is_active' => true,
            'points_ar' => ['نقطة 1', 'نقطة 2'],
            'points_en' => ['Point 1', 'Point 2'],
        ]);

        // Request with Arabic header
        $response = $this->withHeaders(['Accept-Language' => 'ar'])
            ->getJson('/api/services');

        $response->assertStatus(200)
            ->assertJsonPath('data.0.title_ar', 'خدمة تجريبية')
            ->assertJsonPath('data.0.short_description_ar', 'وصف قصير')
            ->assertJsonPath('data.0.long_description_ar', 'وصف طويل للخدمة')
            ->assertJsonPath('data.0.points', ['نقطة 1', 'نقطة 2']);
    }

    public function test_api_returns_english_when_requested()
    {
        // Create a service
        $service = Service::create([
            'title_ar' => 'خدمة تجريبية',
            'title_en' => 'Test Service',
            'short_description_ar' => 'وصف قصير',
            'short_description_en' => 'Short description',
            'long_description_ar' => 'وصف طويل للخدمة',
            'long_description_en' => 'Long description of service',
            'icon' => 'test-icon.png',
            'image' => 'test-image.png',
            'is_active' => true,
            'points_ar' => ['نقطة 1', 'نقطة 2'],
            'points_en' => ['Point 1', 'Point 2'],
        ]);

        // Request with Accept-Language: en
        $response = $this->withHeaders(['Accept-Language' => 'en-US'])
            ->getJson('/api/services');

        $response->assertStatus(200)
            ->assertJsonPath('data.0.title_ar', 'Test Service')
            ->assertJsonPath('data.0.short_description_ar', 'Short description')
            ->assertJsonPath('data.0.long_description_ar', 'Long description of service')
            ->assertJsonPath('data.0.points', ['Point 1', 'Point 2']);
    }

    public function test_api_lookup_bilingual()
    {
        $service = Service::create([
            'title_ar' => 'خدمة تجريبية',
            'title_en' => 'Test Service',
            'short_description_ar' => 'وصف قصير',
            'short_description_en' => 'Short description',
            'long_description_ar' => 'وصف طويل للخدمة',
            'long_description_en' => 'Long description of service',
            'icon' => 'test-icon.png',
            'image' => 'test-image.png',
            'is_active' => true,
        ]);

        // Arabic request
        $responseAr = $this->withHeaders(['Accept-Language' => 'ar'])
            ->getJson('/api/services/lookup');
        $responseAr->assertStatus(200)
            ->assertJsonPath('data.0.title', 'خدمة تجريبية');

        // English request
        $responseEn = $this->withHeaders(['Accept-Language' => 'en'])
            ->getJson('/api/services/lookup');
        $responseEn->assertStatus(200)
            ->assertJsonPath('data.0.title', 'Test Service');
    }
}
