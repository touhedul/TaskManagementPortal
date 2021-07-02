<?php

namespace App\Repositories;

use App\Interfaces\TaskInterface;
use App\Models\Employee;
use App\Models\Task;

class TaskRepository extends BaseRepository implements TaskInterface
{
    protected $model;

    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function taskByEmployee($employeeId)
    {
        return $this->model->where('employee_id', $employeeId)->get();
    }

    // public function todo($employeeId)
    // {
    //     return $this->model->where('employee_id', $employeeId)->where('status', 0)->get();
    // }

    // public function doing($employeeId)
    // {
    //     return $this->model->where('employee_id', $employeeId)->where('status', 1)->get();
    // }

    // public function complete($employeeId)
    // {
    //     return $this->model->where('employee_id', $employeeId)->where('status', 2)->get();
    // }

    public function changeStatus($id, $status)
    {
        $task = $this->model->findOrFail($id);
        $task->status = $status;
        $task->save();

        return $task;
    }
}
