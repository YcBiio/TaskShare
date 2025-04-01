@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Bienvenue, {{ auth()->user()->name }}</h1>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-indigo-500 text-white p-6 rounded shadow">
                <h2 class="text-sm">Total des tâches</h2>
                <p class="text-3xl font-bold">{{ $totalTasks }}</p>
            </div>
            <div class="bg-green-500 text-white p-6 rounded shadow">
                <h2 class="text-sm">Tâches complétées</h2>
                <p class="text-3xl font-bold">{{ $completedTasks }}</p>
            </div>
            <div class="bg-yellow-400 text-gray-800 p-6 rounded shadow">
                <h2 class="text-sm">Tâches à faire aujourd'hui</h2>
                <p class="text-3xl font-bold">{{ $todayTasks }}</p>
            </div>
        </div>

        <!-- Tâches à venir + Listes -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tâches à venir -->
            <div class="md:col-span-2 bg-white p-4 rounded shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Tâches à venir</h3>
                </div>
                <ul class="divide-y divide-gray-100">
                    @forelse($upcomingTasks as $task)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $task->title }}</p>
                                <p class="text-sm text-gray-500">{{ $task->taskList?->name ?? 'Liste inconnue' }}</p>
                            </div>
                            <div class="text-sm text-right">
                                <span class="inline-block px-2 py-1 text-white rounded
                                    {{ $task->status === 'done' ? 'bg-green-500' : 'bg-gray-400' }}">
                                    {{ $task->status }}
                                </span>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ optional($task->due_date)->format('d/m/Y') ?? '—' }}
                                </p>
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-500 py-3">Aucune tâche à venir</li>
                    @endforelse
                </ul>
            </div>

            <!-- Listes -->
            <div class="bg-white p-4 rounded shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Mes listes</h3>
                    <a href="{{ route('task-lists.create') }}" class="text-sm text-indigo-600 hover:underline">
                        + Ajouter
                    </a>
                </div>
                <ul class="space-y-4">
                    @forelse($taskLists as $list)
                        <li>
                            <a href="{{ route('task-lists.show', $list->id) }}" class="text-gray-800 font-medium hover:text-indigo-600">
                                {{ $list->name }}
                            </a>
                            <div class="w-full h-2 bg-gray-200 rounded mt-1">
                                <div class="h-2 {{ $list->completion_percentage > 0 ? 'bg-green-500' : 'bg-gray-400' }} rounded"
                                     style="width: {{ $list->completion_percentage }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500">{{ $list->completion_percentage }}% complété</p>
                        </li>
                    @empty
                        <li class="text-gray-500">Aucune liste créée</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
