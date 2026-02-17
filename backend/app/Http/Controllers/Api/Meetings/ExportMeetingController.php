<?php

namespace App\Http\Controllers\Api\Meetings;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExportMeetingController extends Controller
{
    use AuthorizesRequests;

    // Export meeting report as PDF
    public function __invoke(Meeting $meeting)
    {
        $this->authorize('view', $meeting);

        $meeting->load('agendaItems');

        $pdf = Pdf::loadView('pdf.meeting-report', compact('meeting'));

        return $pdf->download("meeting-{$meeting->id}.pdf");
    }
}
