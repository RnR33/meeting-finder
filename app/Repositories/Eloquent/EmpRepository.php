<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Repositories\Contracts\EmpRepositoryInterface;

class EmpRepository extends BaseRepository implements EmpRepositoryInterface
{
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }
}
