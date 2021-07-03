<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;

class EmployeeRepository extends BaseRepository implements EmployeeInterface
{
    protected $model;

    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function latestEmployee()
    {
        return $this->model->latest()->get();
    }

}
