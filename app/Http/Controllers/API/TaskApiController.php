<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Interfaces\TaskInterface;

class TaskAPIController extends Controller
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


    public function store(TaskRequest $request)
    {
        $task = $this->taskRepository->create($request->all());

        return $this->jsonResponse(new TaskResource($task), 'Task saved successfully', 201);
    }


    public function show($id)
    {
        $task = $this->taskRepository->find($id);

        return $this->jsonResponse(new TaskResource($task), 'Task retrieved successfully', 200);
    }


    public function update(TaskRequest $request, $id)
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


    public function changeStatus($id, $status)
    {
        $task = $this->taskRepository->changeStatus($id, $status);

        return $this->jsonResponse(new TaskResource($task), 'Task status update successfully', 200);
    }
}
