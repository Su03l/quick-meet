<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Mail\MeetingInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ParticipantController extends Controller
{
    public function register(Request $request, Meeting $meeting)
    {
        // 1. التحقق من العدد الأقصى للمشاركين
        if ($meeting->participants()->count() >= $meeting->max_participants) {
            return response()->json(['message' => 'عفواً، الجلسة اكتملت!'], 422);
        }

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
        ]);

        // 2. حفظ المشارك
        $participant = $meeting->participants()->create($data);

        // 3. إرسال الإيميل
        Mail::to($participant->email)->send(new MeetingInvitation($meeting));

        return response()->json(['message' => 'تم تسجيلك بنجاح، تفقد بريدك الإلكتروني!']);
    }
}
