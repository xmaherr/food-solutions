<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin:0; padding:0; background-color:#f0ede8; font-family: Tahoma, Arial, sans-serif; direction:rtl;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f0ede8;">
        <tr>
            <td align="center" style="padding: 40px 16px;">

                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%;">

                    <!-- ===== HEADER ===== -->
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #14594F 0%, #1a7a6e 60%, #0f403a 100%); border-radius: 16px 16px 0 0; padding: 36px 32px 28px; text-align: center;">
                            <p
                                style="margin:0 0 12px 0; display:inline-block; background:rgba(255,244,226,0.15); color:#FFF4E2; font-size:12px; font-weight:bold; padding:4px 16px; border-radius:20px; border:1px solid rgba(255,244,226,0.3);">
                                🌿 &nbsp; Food Solutions
                            </p>
                            <h1 style="margin:0; color:#FFF4E2; font-size:26px; font-weight:900; line-height:1.5;">طلب
                                استشارة جديد</h1>
                            <p style="margin:8px 0 0 0; color:rgba(255,244,226,0.75); font-size:13px;">تم استلام طلب
                                جديد عبر الموقع الإلكتروني</p>
                        </td>
                    </tr>

                    <!-- ===== CARD ===== -->
                    <tr>
                        <td
                            style="background:#ffffff; border-radius: 0 0 16px 16px; overflow:hidden; box-shadow: 0 8px 32px rgba(20,89,79,0.10);">

                            <!-- Intro -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding: 24px 32px 20px; border-bottom: 1px solid #f0ede8;">
                                        <p
                                            style="margin:0; color:#666; font-size:14px; line-height:1.8; text-align:right;">
                                            مرحباً، وصل طلب استشارة جديد من العميل أدناه. يرجى مراجعة التفاصيل والتواصل
                                            معه في أقرب وقت.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Fields -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                <!-- الاسم -->
                                <tr>
                                    <td style="padding: 16px 32px; border-bottom: 1px solid #f5f3f0;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="vertical-align: middle; padding-left: 14px;">
                                                    <div
                                                        style="width:40px; height:40px; background:#f0f9f8; border-radius:10px; text-align:center; line-height:40px; font-size:18px;">
                                                        👤</div>
                                                </td>
                                                <td style="vertical-align: middle; text-align:right;">
                                                    <p
                                                        style="margin:0 0 3px 0; font-size:11px; font-weight:bold; color:#14594F;">
                                                        الاسم</p>
                                                    <p style="margin:0; font-size:15px; font-weight:bold; color:#222;">
                                                        {{ $consultation->name }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- رقم الهاتف -->
                                <tr>
                                    <td style="padding: 16px 32px; border-bottom: 1px solid #f5f3f0;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="vertical-align: middle; padding-left: 14px;">
                                                    <div
                                                        style="width:40px; height:40px; background:#f0f9f8; border-radius:10px; text-align:center; line-height:40px; font-size:18px;">
                                                        📞</div>
                                                </td>
                                                <td style="vertical-align: middle; text-align:right;">
                                                    <p
                                                        style="margin:0 0 3px 0; font-size:11px; font-weight:bold; color:#14594F;">
                                                        رقم الهاتف</p>
                                                    <p style="margin:0; font-size:15px; font-weight:bold; color:#222;">
                                                        {{ $consultation->phone }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- البريد الإلكتروني -->
                                <tr>
                                    <td style="padding: 16px 32px; border-bottom: 1px solid #f5f3f0;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="vertical-align: middle; padding-left: 14px;">
                                                    <div
                                                        style="width:40px; height:40px; background:#f0f9f8; border-radius:10px; text-align:center; line-height:40px; font-size:18px;">
                                                        ✉️</div>
                                                </td>
                                                <td style="vertical-align: middle; text-align:right;">
                                                    <p
                                                        style="margin:0 0 3px 0; font-size:11px; font-weight:bold; color:#14594F;">
                                                        البريد الإلكتروني</p>
                                                    <p style="margin:0; font-size:15px; font-weight:bold; color:#222;">
                                                        {{ $consultation->email }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- الخدمة -->
                                <tr>
                                    <td style="padding: 16px 32px; border-bottom: 1px solid #f5f3f0;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="vertical-align: middle; padding-left: 14px;">
                                                    <div
                                                        style="width:40px; height:40px; background:#f0f9f8; border-radius:10px; text-align:center; line-height:40px; font-size:18px;">
                                                        🍃</div>
                                                </td>
                                                <td style="vertical-align: middle; text-align:right;">
                                                    <p
                                                        style="margin:0 0 3px 0; font-size:11px; font-weight:bold; color:#14594F;">
                                                        الخدمة المطلوبة</p>
                                                    <p style="margin:0; font-size:15px; font-weight:bold; color:#222;">
                                                        {{ $consultation->service ? $consultation->service->title_ar : 'غير محدد' }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- الرسالة -->
                                <tr>
                                    <td style="padding: 16px 32px;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="vertical-align: top; padding-left: 14px; width:54px;">
                                                    <div
                                                        style="width:40px; height:40px; background:#f0f9f8; border-radius:10px; text-align:center; line-height:40px; font-size:18px;">
                                                        💬</div>
                                                </td>
                                                <td style="vertical-align: top; text-align:right;">
                                                    <p
                                                        style="margin:0 0 8px 0; font-size:11px; font-weight:bold; color:#14594F;">
                                                        الرسالة</p>
                                                    <p
                                                        style="margin:0; font-size:14px; color:#444; line-height:1.8; background:#fafaf9; padding:12px 16px; border-radius:8px; border-right:3px solid #14594F;">
                                                        {{ $consultation->message ?? 'لا توجد رسالة' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>

                            <!-- CTA -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td
                                        style="background:#fafaf8; border-top:1px solid #f0ede8; padding:18px 32px; text-align:center;">
                                        <p style="margin:0; font-size:13px; color:#888;">📅 &nbsp; يرجى الرد على العميل
                                            خلال 24 ساعة</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- ===== FOOTER ===== -->
                    <tr>
                        <td style="text-align:center; padding:24px 16px 0;">
                            <p style="margin:0; font-size:12px; color:#aaa; line-height:1.8;">
                                جميع الحقوق محفوظة &copy; {{ date('Y') }} <strong style="color:#14594F;">Food
                                    Solutions</strong><br>
                                هذا البريد أُرسل تلقائياً، يرجى عدم الرد عليه مباشرةً
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>