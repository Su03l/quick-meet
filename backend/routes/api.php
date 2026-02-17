<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\Meetings\MeetingController;
use App\Http\Controllers\Api\Meetings\ExportMeetingController;
use App\Http\Controllers\Api\Participants\ParticipantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Guest Registration for Meetings
Route::post('meetings/{meeting}/register-participant', [ParticipantController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Requires Sanctum Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // User Profile & Management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('/update', [ProfileController::class, 'update']);
        Route::patch('/change-password', [ProfileController::class, 'changePassword']);
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Meetings Management
    Route::apiResource('meetings', MeetingController::class);

    // Meeting Participants
    Route::get('meetings/{meeting}/participants', [MeetingController::class, 'participants']);

    // Meeting Status Update (Start/End Timer)
    Route::patch('meetings/{meeting}/status', [MeetingController::class, 'updateStatus']);

    // Agenda Item Toggle (Complete/Incomplete)
    Route::patch('meetings/{meeting}/agenda/{item}/toggle', [MeetingController::class, 'toggleAgendaItem']);

    // Export Meeting Report (PDF)
    Route::get('meetings/{meeting}/export', ExportMeetingController::class);
});
