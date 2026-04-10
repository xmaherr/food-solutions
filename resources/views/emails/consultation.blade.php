<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Tahoma, Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background: #14594F; color: #FFF4E2; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #14594F; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>طلب استشارة جديد</h2>
        </div>
        <div class="content">
            <div class="field"><span class="label">الاسم:</span> {{ $consultation->name }}</div>
            <div class="field"><span class="label">رقم الهاتف:</span> {{ $consultation->phone }}</div>
            <div class="field"><span class="label">البريد الإلكتروني:</span> {{ $consultation->email }}</div>
            <div class="field"><span class="label">الخدمة:</span> {{ $consultation->service ? $consultation->service->title_ar : 'غير محدد' }}</div>
            <div class="field"><span class="label">الرسالة:</span><br> {{ $consultation->message ?? 'لا توجد رسالة' }}</div>
        </div>
    </div>
</body>
</html>
