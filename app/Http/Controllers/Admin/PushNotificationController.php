<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationArchive;
use App\Services\FirebaseNotificationService;

class PushNotificationController extends Controller
{
    // حقن خدمة الفايربيز تلقائياً
    public function __construct(protected FirebaseNotificationService $firebaseService)
    {
    }

    // عرض أرشيف الإشعارات المرسلة سابقاً
    public function index()
    {
        $notifications = NotificationArchive::latest()->get();
        return view('admin.push-notifications.index', compact('notifications'));
    }

    // صفحة كتابة إشعار جديد
    public function create()
    {
        return view('admin.push-notifications.create');
    }

    // إرسال الإشعار وحفظه في الأرشيف
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $data['topic'] = 'all_users'; // القناة العامة الافتراضية للموبايل

        // 1. استدعاء خدمة الفايربيز للإرسال الفوري لـ كافه الأجهزة
        $isSent = $this->firebaseService->sendToTopic($data['topic'], $data['title'], $data['body']);

        $data['is_sent'] = $isSent;

        // 2. حفظ الإشعار في الـ Database للأرشيف
        NotificationArchive::create($data);

        if ($isSent) {
            return redirect()->route('admin.push-notifications.index')
                ->with('success', 'Push Notification broadcasted successfully to all devices!');
        }

        return redirect()->route('admin.push-notifications.index')
            ->with('error', 'Notification saved to archive but failed to broadcast via Firebase (Check config/credentials).');
    }
}