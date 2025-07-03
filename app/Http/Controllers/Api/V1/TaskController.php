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
        // ! This route is deactivated.
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

        if(auth()->user()->cannot('view', $task))
        {
            return response()->json([
                'message' => 'Unauthorized.'
            ]);
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

        if($request->user()->cannot('update', $task))
        {
            return response()->json([
                'message' => 'Unauthorized.'
            ]);
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

        if(auth()->user()->cannot('delete', $task))
        {
            return response()->json([
                'message' => 'Unauthorized.'
            ]);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task deleted.'
        ]);
    }
}
