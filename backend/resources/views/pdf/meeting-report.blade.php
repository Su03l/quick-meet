<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0px; }
        body {
            font-family: 'Arial', sans-serif;
            text-align: right;
            background-color: #f8fafc;
            margin: 0;
            padding: 40px;
            color: #1e293b;
        }
        .container {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50px;
            margin-bottom: 20px;
            border: 1px solid #bae6fd;
        }
        .header h1 {
            color: #0f172a;
            font-size: 28px;
            margin: 0 0 10px 0;
        }
        .header p {
            color: #64748b;
            font-size: 16px;
            margin: 0 0 30px 0;
            line-height: 1.6;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #0ea5e9;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .agenda-item {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            border-right: 4px solid #0ea5e9;
        }
        .agenda-item .topic {
            font-weight: bold;
            color: #334155;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .agenda-item .meta {
            font-size: 13px;
            color: #64748b;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }
        .status-ended {
            color: #10b981;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="badge">Quick-Meet Report</div>

        <div class="header">
            <h1>محضر اجتماع: {{ $meeting->title }}</h1>
            <p>{{ $meeting->description }}</p>
        </div>

        <div class="section-title">تفاصيل الجلسة</div>
        <table style="width: 100%; margin-bottom: 30px; font-size: 14px;">
            <tr>
                <td style="color: #64748b;">الحالة:</td>
                <td class="status-ended">مكتمل</td>
                <td style="color: #64748b;">التاريخ:</td>
                <td>{{ $meeting->created_at->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td style="color: #64748b;">المدة الإجمالية:</td>
                <td>{{ $meeting->duration_minutes }} دقيقة</td>
                <td style="color: #64748b;">عدد الحضور:</td>
                <td>{{ $meeting->participants->count() }} مشارك</td>
            </tr>
        </table>

        <div class="section-title">أجندة الاجتماع وما تم نقاشه</div>
        @foreach($meeting->agendaItems as $item)
            <div class="agenda-item">
                <div class="topic">{{ $item->topic }}</div>
                <div class="meta">
                    المتحدث: {{ $item->speaker_name ?? 'غير محدد' }} |
                    الوقت المخصص: {{ $item->allocated_minutes }} دقيقة |
                    الحالة: {{ $item->is_completed ? '✅ تم الإنجاز' : '❌ لم يكتمل' }}
                </div>
            </div>
        @endforeach

        <div class="footer">
            تم توليد هذا التقرير تلقائياً بواسطة نظام Quick-Meet <br>
            جميع الحقوق محفوظة © {{ date('Y') }}
        </div>
    </div>
</body>
</html>
