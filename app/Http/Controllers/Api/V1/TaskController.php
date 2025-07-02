<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $newTask = Task::create($validated);

        return new TaskResource($newTask);
    }

    public function show($taskID)
    {
        $task = Task::find($taskID);

        if(!$task)
        {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        return new TaskResource($task);
    }

    public function update($taskID, StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $task = Task::find($taskID);

        if(!$task)
        {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        $task->update($validated);

        return new TaskResource($task);
    }

    public function destroy($taskID)
    {
        $task = Task::find($taskID);

        if(!$task)
        {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task deleted.'
        ]);
    }
}
