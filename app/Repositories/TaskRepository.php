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

}
