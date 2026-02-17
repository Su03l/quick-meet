<?php

namespace App\Services;

use App\Models\Meeting;
use App\Mail\MeetingReportMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MeetingService
{
    /**
     * إنشاء اجتماع جديد مع الأجندة الخاصة به
     */
    public function createMeeting(array $data, int $userId): Meeting
    {
        return DB::transaction(function () use ($data, $userId) {
            $meeting = Meeting::create([
                'user_id' => $userId,
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'duration_minutes' => $data['duration_minutes'],
                'max_participants' => $data['max_participants'] ?? 10,
                'status' => 'scheduled',
            ]);

            if (isset($data['agenda_items']) && is_array($data['agenda_items'])) {
                foreach ($data['agenda_items'] as $item) {
                    $meeting->agendaItems()->create([
                        'topic' => $item['topic'],
                        'speaker_name' => $item['speaker_name'] ?? null,
                        'allocated_minutes' => $item['allocated_minutes'] ?? 5,
                    ]);
                }
            }

            return $meeting->load('agendaItems');
        });
    }

    /**
     * تحديث حالة الاجتماع (بدء التايمر)
     */
    public function startMeeting(Meeting $meeting)
    {
        return $meeting->update([
            'status' => 'live',
            'started_at' => now(),
        ]);
    }

    /**
     * إرسال التقارير النهائية لجميع المشاركين
     */
    public function sendFinalReports(Meeting $meeting)
    {
        $meeting->load(['agendaItems', 'participants']);

        // توليد الـ PDF
        $pdf = Pdf::loadView('pdf.meeting-report', compact('meeting'));
        $pdfContent = $pdf->output();

        // إرسال الإيميل لكل مشارك
        foreach ($meeting->participants as $participant) {
            Mail::to($participant->email)->send(new MeetingReportMail($meeting, $pdfContent));
        }

        // إرسال نسخة لصاحب الاجتماع أيضاً
        Mail::to($meeting->user->email)->send(new MeetingReportMail($meeting, $pdfContent));
    }
}
