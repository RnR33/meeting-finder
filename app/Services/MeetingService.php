<?php

namespace App\Services;

use App\Repositories\Contracts\EmpRepositoryInterface;
use App\Repositories\Contracts\MeetingRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Exception;
use App\Traits\BusinessHours;

/**
 *
 */
class MeetingService
{
    /**
     * @var MeetingRepositoryInterface
     */
    protected $meetingRepository;
    protected $empRepository;

    use BusinessHours;
    public function __construct(MeetingRepositoryInterface $meetingRepository, EmpRepositoryInterface $empRepository)
    {
        $this->meetingRepository = $meetingRepository;
        $this->empRepository = $empRepository;
    }


    /**
     * Store meeting data from txt file
     * @param $meetingData
     * @return void
     */
    public function storeMeetingData($meetingData): void
    {
        foreach ($meetingData as $data) {
            $insertData = [
                "emp_id" => $data[0],
                "start_dateTime" => Carbon::parse($data[1])->toDateTime(),
                "end_dateTime" => Carbon::parse($data[2])->toDateTime(),
                "details" => $data[3],
            ];
            $this->meetingRepository->create($insertData);
        }
    }


    /**
     * Get available time slots according to request
     * @param $request
     * @return array
     * @throws Exception
     */
    public function getAvailableTimeSlots($request): array
    {
        $start = Carbon::instance(new \DateTime($request['schedule_from']));
        $end = Carbon::instance(new \DateTime($request['schedule_to']));

        $getEmpMeetings = $this->empRepository->findAllBy('emp_id', explode(',', $request['emp_id']), 'meeting');

        if (!count($getEmpMeetings) > 0) {

            return ['error' => 'No employee or employees'];
        }

        $bookedDates = $this->getBookedDates($getEmpMeetings);

        $minimumInterval = CarbonInterval::createFromFormat('H:i', $request['meeting_duration']);

        $requestInterval = CarbonInterval::createFromFormat('H:i', $request['meeting_slot']);

        $availableDates = [];

        foreach (new CarbonPeriod($start, $minimumInterval, $end) as $from) {

            $to = $from->copy()->add($requestInterval);

            if ($this->availableSlots($from, $to, $bookedDates)
                && ($this->checkBusinessHours($from->toDateTimeString())
                    && $this->checkBusinessHours($to->toDateTimeString()))) {
                    $availableDates[] = ['from' => $from->toDateTimeString(), 'to' => $to->toDateTimeString()];
                }
            }

        return $this->formattedResource($getEmpMeetings, $availableDates);
    }

    /**
     * get meeting data from employee
     * @param $getEmpMeetings
     * @return array
     */
    private function getBookedDates($getEmpMeetings): array
    {
        $bookedDates = [];
        foreach ($getEmpMeetings as $empData) {
            foreach ($empData->meeting as $item => $data) {
                $bookedDates[$item] =  ['start' => $data->start_dateTime, 'end' =>  $data->end_dateTime];
            }

        }

        return $bookedDates;
    }


    /**
     * get available time slots
     * @param $from
     * @param $to
     * @param $bookedDates
     * @return bool
     * @throws Exception
     */
    private function availableSlots($from, $to, $bookedDates): bool
    {
        foreach ($bookedDates as $dates) {

            $start = Carbon::instance(new \DateTime($dates['start']));
            $end = Carbon::instance(new \DateTime($dates['end']));

            if ($from->between($start, $end) || $to->between($start, $end)
                || ($start->between($from, $to) && $end->between($from, $to))) {
                return false;
            }
        }
       return true;
    }

    /**
     * make formatted resource
     * @param $empMeeting
     * @param $availableDates
     * @return array
     */
    private function formattedResource($empMeeting, $availableDates): array
    {
        foreach ($empMeeting as $empDetails) {
            $employee[] = [
                'id' => $empDetails->id,
                'emp_id' => $empDetails->emp_id,
                'name' => $empDetails->name
            ];
        }
        return ['empDetails' => $employee,'availableSlots' => $availableDates];
    }

}
