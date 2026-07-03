<?php

namespace App\Services;

use App\Mail\ConsultationMail;
use App\Models\Consultation;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ConsultationService
{
    public function store(array $data): Consultation
    {
        $user = auth('sanctum')->user() ?? null;
        $consultation = Consultation::create([
            'user_id' => $user?->id ?? null,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'service_id' => $data['service_id'],
            'message' => $data['message'] ?? null,
        ]);

        $this->sendNotification($consultation);

        return $consultation;
    }

    private function sendNotification(Consultation $consultation): void
    {
        $emailSetting = Setting::where('key', 'consultation_email')->first();

        if (!$emailSetting?->value) {
            return;
        }

        try {
            Mail::to($emailSetting->value)->send(new ConsultationMail($consultation));
        } catch (\Exception $e) {
            Log::error('Failed to send consultation email: ' . $e->getMessage());
        }
    }
}
