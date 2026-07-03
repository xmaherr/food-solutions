<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService
{
    /**
     * توليد الـ Access Token المؤقت باستخدام ملف الـ JSON
     */
    private function getGoogleAccessToken(): ?string
    {
        try {
            $filePath = base_path(env('FIREBASE_CREDENTIALS_PATH'));

            if (!file_exists($filePath)) {
                Log::error("Firebase credentials file not found at: " . $filePath);
                return null;
            }

            $client = new GoogleClient();
            $client->setAuthConfig($filePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $client->fetchAccessTokenWithAssertion();

            $token = $client->getAccessToken();
            return $token['access_token'] ?? null;
        } catch (\Exception $e) {
            Log::error("Failed to generate Firebase Access Token: " . $e->getMessage());
            return null;
        }
    }

    /**
     * إرسال إشعار عام لكل مستخدمين التطبيق المشتركين في topic معين
     */
    public function sendToTopic(string $topic, string $title, string $body, array $data = []): bool
    {
        $accessToken = $this->getGoogleAccessToken();
        $projectId = env('FIREBASE_PROJECT_ID');

        if (!$accessToken || !$projectId) {
            Log::error("Firebase Notification skipped: Missing Token or Project ID.");
            return false;
        }

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $response = Http::withToken($accessToken)
            ->post($url, [
                'message' => [
                    'topic' => $topic, // التطبيق هيشترك في الـ topic ده وليكن 'all_users'
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'data' => array_merge([
                        'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                        'sent_at' => now()->toIso8601String()
                    ], $data)
                ]
            ]);

        if ($response->successful()) {
            return true;
        }

        Log::error("Firebase API Response Failed: " . $response->body());
        return false;
    }
}