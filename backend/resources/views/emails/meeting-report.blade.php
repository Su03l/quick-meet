<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
            color: #1e293b;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #ecfdf5;
            color: #047857;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50px;
            margin-bottom: 20px;
            border: 1px solid #d1fae5;
        }
        .header h2 {
            color: #10b981;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .header p {
            color: #64748b;
            font-size: 16px;
            margin: 0 0 30px 0;
            line-height: 1.6;
        }
        .info-box {
            background-color: #f0fdf4;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border-right: 4px solid #10b981;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="badge">Quick-Meet Report</div>

        <div class="header">
            <h2>تم انتهاء اجتماع {{ $title }} بنجاح</h2>
            <p>نشكركم على حضوركم ومشاركتكم. تجدون مرفقاً مع هذا الإيميل محضر الاجتماع كاملاً بصيغة PDF.</p>
        </div>

        <div class="info-box">
            <p>يحتوي التقرير المرفق على:</p>
            <ul style="padding-right: 20px;">
                <li>ملخص الجلسة</li>
                <li>الأجندة التي تمت مناقشتها</li>
                <li>حالة كل بند في الاجتماع</li>
            </ul>
        </div>

        <div class="footer">
            تم الإرسال عبر منصة Quick-Meet <br>
            جميع الحقوق محفوظة © {{ date('Y') }}
        </div>
    </div>
</body>
</html>
