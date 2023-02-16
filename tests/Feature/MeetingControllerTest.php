<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MeetingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_available_slots()
    {
        $this->withoutExceptionHandling();

        $formData = [
            'emp_id' => '57646786307395936680161735716561753784',
            'schedule_from' => '2015-01-02 08:00:00',
            'schedule_to' => '2015-01-05 17:00:00',
            'meeting_duration' => '01:00',
            'meeting_slot' => '01:00'
        ];

        $this->post(url('api/available-slots'),$formData)
            ->assertStatus(200);
    }

    public function test_bad_request()
    {
        $this->withoutExceptionHandling();

        $formData = [
            'emp_id' => '57646786307395936680161735716561753784',
            'schedule_from' => ' 08:00:00',
            'schedule_to' => '2015-01-05 17:00:00',
            'meeting_duration' => '01:00',
            'meeting_slot' => '01:00'
        ];

        $this->post(url('api/available-slots'),$formData)
            ->assertBadRequest();
    }
}
