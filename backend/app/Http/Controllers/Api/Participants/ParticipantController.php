<?php

namespace App\Http\Controllers\Api\Participants;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Mail\MeetingInvitation;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    use ApiResponseTrait;

    public function register(Request $request, Meeting $meeting)
    {
        // إذا كان المستخدم مسجل دخول، نسحب بياناته، وإلا نتحقق من البيانات المرسلة
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
            $data = [
                'name' => $user->name,
                'email' => $user->email,
            ];
        } else {
            $data = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email',
            ]);
        }

        return DB::transaction(function () use ($meeting, $data) {
            $currentMeeting = Meeting::where('id', $meeting->id)->lockForUpdate()->first();

            if ($currentMeeting->participants()->count() >= $currentMeeting->max_participants) {
                return $this->errorResponse('عفواً، الجلسة اكتملت!', 422);
            }

            $exists = $currentMeeting->participants()->where('email', $data['email'])->exists();
            if ($exists) {
                return $this->errorResponse('أنت مسجل مسبقاً في هذا الاجتماع!', 422);
            }

            $participant = $currentMeeting->participants()->create($data);

            // إرسال الإيميل (تأكد من تشغيل php artisan queue:work)
            Mail::to($participant->email)->send(new MeetingInvitation($currentMeeting));

            return $this->successResponse(null, 'تم تسجيلك بنجاح، تفقد بريدك الإلكتروني!');
        });
    }
}
