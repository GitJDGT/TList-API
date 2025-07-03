<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TaskList;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TaskListResource;
use App\Http\Requests\StoreTaskListRequest;

class TaskListController extends Controller
{
    public function index()
    {
        return TaskListResource::collection(TaskList::where('user_id', Auth::user()->id)->get());
    }

    public function store(StoreTaskListRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::user()->id;

        $newTaskList = TaskList::create($validated);

        return new TaskListResource($newTaskList);
    }

    public function show($taskListID)
    {
        $taskList = TaskList::with('tasks')->find($taskListID);

        if(!$taskList)
        {
            return response()->json([
                'message' => 'Task list not found.'
            ], 404);
        }

        if(auth()->user()->cannot('view', $taskList))
        {
            return response()->json([
                'message' => 'Unauthorized.'
            ]);
        }

        return new TaskListResource($taskList);
    }

    public function update($taskListID, StoreTaskListRequest $request)
    {
        $validated = $request->validated();

        $taskList = TaskList::find($taskListID);

        if(!$taskList)
        {
            return response()->json([
                'message' => 'Task list not found.'
            ], 404);
        }

        if($request->user()->cannot('update', $taskList))
        {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 403);
        }

        $taskList->update($validated);

        return new TaskListResource($taskList);
    }

    public function destroy($taskListID)
    {
        $taskList = TaskList::find($taskListID);

        if(!$taskList)
        {
            return response()->json([
                'message' => 'Task list not found.'
            ], 404);
        }

        if(auth()->user()->cannot('delete', $taskList))
        {
            return response()->json([
                'message' => 'Unauthorized.'
            ]);
        }

        $taskList->delete();

        return response()->json([
            'message' => 'Task list deleted.'
        ], 200);
    }
}
