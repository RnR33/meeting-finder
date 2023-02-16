<?php

namespace App\Http\Controllers;

use App\Services\MeetingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingsController extends Controller
{

    protected $meetingService;

    public function __construct(MeetingService $meetingService)
    {
        $this->meetingService = $meetingService;
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'schedule_from' => 'required|date_format:Y-m-d H:i:s',
                'schedule_to' => 'required|date_format:Y-m-d H:i:s|after:schedule_from',
                'meeting_duration' => 'required|date_format:H:i',
                'meeting_slot' => 'required|date_format:H:i',
            ]);

            if ($validator->fails()) {

                return response()->json(['error' => $validator->messages()], 400);

            } else {
                $response = $this->meetingService->getAvailableTimeSlots($request->all());

                return response()->json($response, 200);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

}
