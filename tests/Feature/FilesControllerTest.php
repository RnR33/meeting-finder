<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Tests\TestCase;

class FilesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_read_file_and_store()
    {
        $this->withoutExceptionHandling();

        $file = File::createWithContent('data.txt',$this->fileContent());

        $this->post(url('api/file-upload'),[
            'file' => $file
        ])->assertStatus(201);

    }

    public function test_upload_wrong_file()
    {
        $this->withoutExceptionHandling();

        $file = File::createWithContent('data.pdf',$this->fileContent());

        $this->post(url('api/file-upload'),[
            'file' => $file
        ])->assertBadRequest();

    }

    private function fileContent(): string
    {
        return '57646786307395936680161735716561753784;3/13/2015 8:00:00 AM;3/13/2015 1:00:00 PM;C5CAACCED1B9F361761853A7F995A1D4F16C8BCD0A5001A2DF3EC0D7CD539A09AA7DDA1A5278FA07554B0260880882CCBB30B3399C3C0974C587A8233E5788A81DEAD2921123CB12D13CC11318C38B9679D868145315F1BE24333202D12B3787E51D1BBF97BB25482B0EF7E97DE637BAACEDD74E89E2AC52139EE9369F1D64A6
                    276908764613820584354290536660008166629;Kenneth Polo';
    }
}
