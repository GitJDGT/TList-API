<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function store()
    {

    }

    public function show($taskID)
    {
        return new TaskResource(Task::findOrFail($taskID));
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
