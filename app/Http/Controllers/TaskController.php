<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{

    // Get List
    public function index()
    {
        $tasks = Task::all()->map(function ($item)
        {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'start' => $item->start_date,
                'end' => $item->end_date . ' 23:59:59',
                'assigned_to' => $item->assigned_to,
                'priority' => $item->priority,
                'status' => $item->status,
            ];
        });

        return response()->json($tasks);
    }

    // Store
    public function store(CreateTaskRequest $request)
    {
        $task = Task::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return response()->json($task, 201);
    }

}
