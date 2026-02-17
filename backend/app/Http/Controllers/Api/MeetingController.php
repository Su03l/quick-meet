<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MeetingResource;
use App\Http\Resources\AgendaItemResource;
use App\Models\Meeting;
use App\Models\AgendaItem;
use App\Services\MeetingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MeetingController extends Controller
{
    use AuthorizesRequests;

    protected $meetingService;

    public function __construct(MeetingService $meetingService)
    {
        $this->meetingService = $meetingService;
    }

    public function index(Request $request)
    {
        $meetings = $request->user()->meetings()->with('agendaItems')->latest()->paginate(10);
        return MeetingResource::collection($meetings);
    }

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

        return new MeetingResource($meeting);
    }

    public function show(Meeting $meeting)
    {
        $this->authorize('view', $meeting);
        return new MeetingResource($meeting->load('agendaItems'));
    }

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

        return new MeetingResource($meeting->load('agendaItems'));
    }

    public function destroy(Meeting $meeting)
    {
        $this->authorize('delete', $meeting);
        $meeting->delete();
        return response()->json(['message' => 'تم حذف الاجتماع بنجاح']);
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

        return new MeetingResource($meeting->load('agendaItems'));
    }

    public function toggleAgendaItem(Meeting $meeting, AgendaItem $item)
    {
        $this->authorize('update', $meeting);

        if ($item->meeting_id !== $meeting->id) {
            return response()->json(['message' => 'هذا البند لا ينتمي لهذا الاجتماع'], 403);
        }

        $item->update(['is_completed' => !$item->is_completed]);
        return new AgendaItemResource($item);
    }
}
