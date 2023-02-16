<?php

namespace App\Services;

use App\Repositories\Contracts\EmpRepositoryInterface;

class EmployeeService
{

    protected $employeeRepository;

    public function __construct(EmpRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }


    /**
     * Store Emp data
     * @param $empData
     * @return void
     */
    public function storeEmpData($empData):void
    {
        foreach ($empData as $data) {
            $insertData = [
                "emp_id" => $data[0],
                "name" => $data[1],
            ];
            $this->employeeRepository->create($insertData);
        }

    }

}
