<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExportMeetingController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Meeting $meeting)
    {
        // التأكد من الصلاحية
        $this->authorize('view', $meeting);

        $meeting->load('agendaItems');

        // إرسال البيانات لملف Blade
        $pdf = Pdf::loadView('pdf.meeting-report', compact('meeting'));

        // تحميل الملف باسم الاجتماع
        return $pdf->download("meeting-{$meeting->id}.pdf");
    }
}
