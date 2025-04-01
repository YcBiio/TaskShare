@extends('layouts.app')

@section('title', 'Mes listes')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Mes listes</h1>
            <a href="{{ route('task-lists.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm">
                + Nouvelle liste
            </a>
        </div>

        @if ($lists->count() === 0 && $sharedLists->count() === 0)
            <p class="text-gray-500 text-center">Tu n’as encore aucune liste de tâches.</p>
        @endif

        <!-- Mes listes -->
        @if ($lists->count())
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">📋 Mes listes</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($lists as $list)
                        <div class="bg-white rounded shadow p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-lg">{{ $list->name }}</h3>
                                <form action="{{ route('task-lists.destroy', $list->id) }}" method="POST"
                                      onsubmit="return confirm('Supprimer cette liste ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline text-sm">🗑️</button>
                                </form>
                            </div>
                            <p class="text-sm text-gray-500 mb-2">
                                {{ $list->tasks_count }} tâche{{ $list->tasks_count === 1 ? '' : 's' }}
                            </p>
                            <div class="w-full h-2 bg-gray-200 rounded mb-2">
                                <div class="h-2 bg-green-500 rounded" style="width: {{ $list->completion_percentage }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500">{{ $list->completion_percentage }}% complété</p>
                            <a href="{{ route('task-lists.show', $list->id) }}"
                               class="mt-3 inline-block text-sm text-indigo-600 hover:underline font-medium">
                                ➤ Voir la liste
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Partagées avec moi -->
        @if ($sharedLists->count())
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">🤝 Partagées avec moi</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($sharedLists as $list)
                        <div class="bg-white rounded shadow p-4">
                            <h3 class="font-semibold text-lg mb-1">{{ $list->name }}</h3>
                            <p class="text-sm text-gray-500 mb-2">
                                {{ $list->tasks_count }} tâche{{ $list->tasks_count === 1 ? '' : 's' }} ·
                                {{ $list->completion_percentage }}% complété
                            </p>
                            <div class="w-full h-2 bg-gray-200 rounded mb-2">
                                <div class="h-2 bg-green-500 rounded" style="width: {{ $list->completion_percentage }}%"></div>
                            </div>
                            <a href="{{ route('task-lists.show', $list->id) }}"
                               class="mt-2 inline-block text-sm text-indigo-600 hover:underline font-medium">
                                ➤ Accéder à la liste
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
