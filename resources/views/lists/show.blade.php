@extends('layouts.app')

@section('title', $taskList->name)

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- En-tête -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold">{{ $taskList->name }}</h1>
                <p class="text-gray-500 text-sm">
                    {{ $taskList->tasks->count() }} tâches · {{ $taskList->completion_percentage }}% complété
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <button id="taskFilterDropdown" class="px-3 py-1.5 text-sm bg-white border border-gray-300 rounded shadow hover:bg-gray-50">
                    🔍 Filtrer
                </button>
                <button id="taskSortDropdown" class="px-3 py-1.5 text-sm bg-white border border-gray-300 rounded shadow hover:bg-gray-50">
                    🔽 Trier
                </button>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1.5 text-sm rounded" data-modal-target="newTaskModal">
                    ➕ Nouvelle tâche
                </button>
                <button class="border border-indigo-600 text-indigo-600 hover:bg-indigo-50 px-4 py-1.5 text-sm rounded" data-modal-target="shareListModal">
                    🤝 Partager
                </button>
            </div>
        </div>

        <!-- Barre de progression -->
        <div class="w-full h-2 bg-gray-200 rounded mb-6">
            <div class="h-2 {{ $taskList->completion_percentage > 0 ? 'bg-green-500' : 'bg-gray-400' }} rounded"
                 style="width: {{ $taskList->completion_percentage }}%"></div>
        </div>

        <!-- Liste des tâches -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($taskList->tasks as $task)
                <div class="p-4 bg-white rounded shadow-sm task-card-container"
                     data-priority="{{ $task->priority }}"
                     data-status="{{ $task->status }}"
                     data-date="{{ optional($task->due_date)->format('Y-m-d') }}"
                     data-name="{{ $task->title }}">
                    <div class="flex justify-between items-start">
                        <h2 class="font-semibold text-lg">{{ $task->title }}</h2>
                        <div class="relative">
                            <button class="text-gray-500 text-sm" data-dropdown-toggle="task-{{ $task->id }}-menu">⋮</button>
                            <div class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow" id="task-{{ $task->id }}-menu">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100" data-modal-target="editTaskModal{{ $task->id }}">
                                    ✏️ Modifier
                                </a>
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 mt-2">{{ $task->description }}</p>
                    <div class="flex justify-between items-center mt-4 text-sm">
                        <span class="status-badge px-2 py-0.5 rounded-full text-white text-xs
                            {{ $task->status === 'done' ? 'bg-green-500' : 'bg-gray-400' }}">
                            {{ $task->status }}
                        </span>
                        <span class="text-gray-500">Échéance : {{ optional($task->due_date)->format('d/m/Y') ?? '—' }}</span>
                    </div>
                    <div class="mt-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox"
                                   class="task-checkbox rounded text-indigo-600"
                                   data-task-id="{{ $task->id }}"
                                {{ $task->status === 'done' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm">Marquer comme terminée</span>
                        </label>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center col-span-full">
                    Aucune tâche. Ajoute-en une pour commencer !
                </p>
            @endforelse
        </div>
    </div>

    <!-- MODALS -->
    @include('lists.partials.modal-new-task', ['taskList' => $taskList])
    @include('lists.partials.modal-share-list', ['taskList' => $taskList])
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const taskId = this.dataset.taskId;
                const isChecked = this.checked;

                fetch(`/tasks/${taskId}/status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        status: isChecked ? 'done' : 'todo'
                    }),
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload(); // recharge la page pour MAJ la barre et le statut
                        }
                    });
            });
        });
    </script>
@endsection
