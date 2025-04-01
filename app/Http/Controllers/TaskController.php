<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, TaskList $taskList)
    {
        $this->authorize('update', $taskList);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'status' => 'required|in:todo,done'
        ]);

        $taskList->tasks()->create($request->only('title', 'description', 'priority', 'due_date', 'status'));

        return back();
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task->taskList);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,done',
            'due_date' => 'nullable|date'
        ]);

        $task->update($request->only('title', 'description', 'priority', 'status', 'due_date'));

        return back();
    }

    public function destroy(Task $task)
    {
        $this->authorize('update', $task->taskList);
        $task->delete();
        return back();
    }
}
