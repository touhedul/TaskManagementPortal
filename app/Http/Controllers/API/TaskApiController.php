<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Interfaces\TaskInterface;
use App\Models\Employee;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    private $taskRepository;

    public function __construct(TaskInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        return $this->taskRepository->all();
    }

    public function store(Request $request)
    {
        $task = $this->taskRepository->create($request->all());
        return $this->jsonResponse(new TaskResource($task), 'Task saved successfully', 201);
    }

    public function show($id)
    {
        $task = $this->taskRepository->find($id);
        return $this->jsonResponse(new TaskResource($task), 'Task retrieved successfully', 200);
    }

    public function update(Request $request, $id)
    {
        $task = $this->taskRepository->update($request->all(), $id);
        return $this->jsonResponse(new TaskResource($task), 'Task update successfully', 200);
    }

    public function destroy($id)
    {
        $this->taskRepository->delete($id);
        return $this->jsonResponse([], 'Task delete successfully', 200);
    }

    public function taskByEmployee($employeeId)
    {
        $tasks = $this->taskRepository->taskByEmployee($employeeId);
        $todoTasks = $tasks->where('status', 0);
        $todoCount = count($todoTasks);
        $doingTasks = $tasks->where('status', 1);
        $doingCount = count($doingTasks);
        $completeTasks = $tasks->where('status', 2);
        $completeCount = count($completeTasks);
        return $this->jsonResponse(
            [
                'todoTasks' => TaskResource::collection($todoTasks), 'todoCount' => $todoCount,
                'doingTasks' => TaskResource::collection($doingTasks), 'doingCount' => $doingCount,
                'completeTasks' => TaskResource::collection($completeTasks), 'completeCount' => $completeCount,
            ],
            'Task retrieved successfully',
            200
        );
    }

    public function todo($employeeId)
    {
        $tasks = $this->taskRepository->todo($employeeId);
        $todoCount = count($tasks);
        return $this->jsonResponse([TaskResource::collection($tasks), 'todoCount' => $todoCount], 'Task retrieved successfully', 200);
    }

    public function doing($employeeId)
    {
        $tasks = $this->taskRepository->doing($employeeId);
        $doingCount = count($tasks);
        return $this->jsonResponse([TaskResource::collection($tasks), 'doingCount' => $doingCount], 'Task retrieved successfully', 200);
    }

    public function complete($employeeId)
    {
        $tasks = $this->taskRepository->complete($employeeId);
        $completeCount = count($tasks);
        return $this->jsonResponse([TaskResource::collection($tasks), 'completeCount' => $completeCount], 'Task retrieved successfully', 200);
    }

    public function changeStatus($id, $status)
    {
        $task = $this->taskRepository->changeStatus($id, $status);
        return $this->jsonResponse(new TaskResource($task), 'Task status update successfully', 200);
    }
}
