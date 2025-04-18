<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Auth::user()->tasks() //не понимаю
            ->search($request->input('search'))
            ->filterByStatus($request->input('status_filter'))
            ->sortBy(
                $request->input('sort'),
                $request->input('direction', 'asc')
            )
            ->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
            'statuses' => Task::getStatuses(),
            'filters' => $request->all(),
        ]);
    }
}