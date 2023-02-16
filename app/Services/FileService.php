<?php

namespace App\Services;


class FileService
{
    protected $meetingService;
    protected $employeeService;
    public function __construct(MeetingService $meetingService, EmployeeService $employeeService)
    {
        $this->meetingService = $meetingService;
        $this->employeeService = $employeeService;
    }

    /**
     * store file data to correct tables
     * @param $file
     * @return void
     */
    public function storeMeetingData($file): void
    {
        $newData = $this->formatFileData($file);

        $empData = [];
        $meetingData = [];

        foreach ($newData as $index => $item) {
            if (count($item) == 2) {
                $empData[$index] = $item;
            } else {
                $meetingData[$index] = $item;
            }

        }

        $this->meetingService->storeMeetingData($meetingData);

        $this->employeeService->storeEmpData($empData);

    }

    /**
     * format file data to store
     * @param $file
     * @return array
     */
    private function formatFileData($file): array
    {
        $dataArr = file($file, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);

        $newData = [];

        foreach ($dataArr as $index => $item) {
            $keys = explode(';', $item);
            $newData[$index] = $keys;
        }

        return $newData;

    }
}
