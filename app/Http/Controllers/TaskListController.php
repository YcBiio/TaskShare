<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskList;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = auth()->user()->taskLists;
        $sharedLists = auth()->user()->sharedTaskLists;
        return view('lists.index', compact('lists', 'sharedLists'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lists.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        auth()->user()->taskLists()->create([
            'name' => $request->name
        ]);

        return redirect()->route('task-lists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskList $taskList)
    {
        $this->authorize('view', $taskList);
        $tasks = $taskList->tasks;
        return view('lists.show', compact('taskList', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskList $taskList)
    {
        $this->authorize('update', $taskList);
        return view('task_lists.edit', compact('taskList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskList $taskList)
    {
        $this->authorize('update', $taskList);
        $request->validate(['name' => 'required|string|max:255']);
        $taskList->update(['name' => $request->name]);
        return redirect()->route('task-lists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskList $taskList)
    {
        $this->authorize('delete', $taskList);
        $taskList->delete();
        return back();
    }
}
