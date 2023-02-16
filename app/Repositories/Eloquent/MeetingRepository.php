<?php

namespace App\Repositories\Eloquent;

use App\Models\Meeting;
use App\Repositories\Contracts\MeetingRepositoryInterface;

class MeetingRepository extends BaseRepository implements MeetingRepositoryInterface
{
    public function __construct(Meeting $model)
    {
        $this->model = $model;
    }
}
