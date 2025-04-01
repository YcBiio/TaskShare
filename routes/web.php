<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Http\Request;

// Page d’accueil (non connectée)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (tableau de bord personnalisé)
Route::get('/dashboard', function () {
    $user = auth()->user();

    $totalTasks = Task::whereHas('taskList', function ($q) use ($user) {
        $q->where('owner_id', $user->id)
            ->orWhereHas('sharedWith', fn($query) => $query->where('user_id', $user->id));
    })->count();

    $completedTasks = Task::where('status', 'done')->whereHas('taskList', function ($q) use ($user) {
        $q->where('owner_id', $user->id)
            ->orWhereHas('sharedWith', fn($query) => $query->where('user_id', $user->id));
    })->count();

    $todayTasks = Task::whereDate('due_date', now()->toDateString())->whereHas('taskList', function ($q) use ($user) {
        $q->where('owner_id', $user->id)
            ->orWhereHas('sharedWith', fn($query) => $query->where('user_id', $user->id));
    })->count();

    $upcomingTasks = Task::whereDate('due_date', '>', now())->orderBy('due_date')->take(5)->get();

    $taskLists = $user->taskLists->map(function ($list) {
        $completed = $list->tasks->where('status', 'done')->count();
        $total = $list->tasks->count();
        $list->completion_percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
        $list->is_shared = false;
        return $list;
    });

    return view('dashboard', compact('totalTasks', 'completedTasks', 'todayTasks', 'upcomingTasks', 'taskLists'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes utilisateur (profil)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('task-lists/{taskList}/share', function () {
    return back(); // ou abort(501) pour signaler que ce n’est pas encore fait
})->name('task-lists.share');

// Gestion des listes et des tâches
Route::middleware(['auth'])->group(function () {
    Route::resource('task-lists', TaskListController::class);
    Route::post('task-lists/{taskList}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // ✅ AJAX - Mise à jour du statut d'une tâche (via checkbox)
    Route::post('/tasks/{task}/status', function (Task $task, Request $request) {
        $request->validate(['status' => 'required|in:done,todo']);

        $user = auth()->user();
        $canUpdate = $task->taskList->owner_id === $user->id
            || $task->taskList->sharedWith->contains($user);

        if (!$canUpdate) {
            abort(403);
        }

        $task->status = $request->status;
        $task->save();

        return response()->json(['success' => true]);
    })->name('tasks.status.update');
});

require __DIR__.'/auth.php';
