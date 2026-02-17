<?php

namespace App\Http\Controllers\Api\Meetings;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeetingResource;
use App\Http\Resources\AgendaItemResource;
use App\Http\Resources\ParticipantResource;
use App\Models\Meeting;
use App\Models\AgendaItem;
use App\Services\MeetingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MeetingController extends Controller
{
    use AuthorizesRequests, ApiResponseTrait;

    // MeetingController
    protected $meetingService;

    // Constructor for MeetingController
    public function __construct(MeetingService $meetingService)
    {
        $this->meetingService = $meetingService;
    }

    // show all meetings for the user
    public function index(Request $request)
    {
        $meetings = $request->user()->meetings()->with('agendaItems')->latest()->paginate(10);
        return $this->successResponse(MeetingResource::collection($meetings));
    }

    // create a new meeting
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'max_participants' => 'nullable|integer|min:1',
            'agenda_items' => 'nullable|array',
            'agenda_items.*.topic' => 'required|string|max:255',
            'agenda_items.*.speaker_name' => 'nullable|string|max:255',
            'agenda_items.*.allocated_minutes' => 'required|integer|min:1',
        ]);

        $meeting = $this->meetingService->createMeeting($data, Auth::id());

        return $this->successResponse(new MeetingResource($meeting), 'تم إنشاء الاجتماع بنجاح', 201);
    }

    // show meeting details and agenda items
    public function show(Meeting $meeting)
    {
        $this->authorize('view', $meeting);
        return $this->successResponse(new MeetingResource($meeting->load(['agendaItems', 'participants'])));
    }

    // update meeting details and agenda items
    public function update(Request $request, Meeting $meeting)
    {
        $this->authorize('update', $meeting);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        $meeting->update($data);

        return $this->successResponse(new MeetingResource($meeting->load('agendaItems')), 'تم تحديث الاجتماع بنجاح');
    }

    public function destroy(Meeting $meeting)
    {
        $this->authorize('delete', $meeting);
        $meeting->delete();
        return $this->successResponse(null, 'تم حذف الاجتماع بنجاح');
    }

    public function updateStatus(Request $request, Meeting $meeting)
    {
        $this->authorize('update', $meeting);

        $data = $request->validate([
            'status' => 'required|in:draft,scheduled,live,ended',
        ]);

        if ($data['status'] === 'live') {
            $this->meetingService->startMeeting($meeting);
        } else {
            $meeting->update(['status' => $data['status']]);
        }

        if ($data['status'] === 'ended') {
            $this->meetingService->sendFinalReports($meeting);
        }

        return $this->successResponse(new MeetingResource($meeting->load('agendaItems')), 'تم تحديث حالة الاجتماع بنجاح');
    }

    public function toggleAgendaItem(Meeting $meeting, AgendaItem $item)
    {
        $this->authorize('update', $meeting);

        if ($item->meeting_id !== $meeting->id) {
            return $this->errorResponse('هذا البند لا ينتمي لهذا الاجتماع', 403);
        }

        $item->update(['is_completed' => !$item->is_completed]);
        return $this->successResponse(new AgendaItemResource($item), 'تم تحديث حالة بند الأجندة');
    }

    public function participants(Meeting $meeting)
    {
        $this->authorize('view', $meeting);
        return $this->successResponse(ParticipantResource::collection($meeting->participants()->latest()->get()));
    }
}
