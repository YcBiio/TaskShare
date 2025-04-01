<?php $__env->startSection('title', $taskList->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto">
        <!-- En-tête -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold"><?php echo e($taskList->name); ?></h1>
                <p class="text-gray-500 text-sm">
                    <?php echo e($taskList->tasks->count()); ?> tâches · <?php echo e($taskList->completion_percentage); ?>% complété
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
            <div class="h-2 <?php echo e($taskList->completion_percentage > 0 ? 'bg-green-500' : 'bg-gray-400'); ?> rounded"
                 style="width: <?php echo e($taskList->completion_percentage); ?>%"></div>
        </div>

        <!-- Liste des tâches -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $taskList->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="p-4 bg-white rounded shadow-sm task-card-container"
                     data-priority="<?php echo e($task->priority); ?>"
                     data-status="<?php echo e($task->status); ?>"
                     data-date="<?php echo e(optional($task->due_date)->format('Y-m-d')); ?>"
                     data-name="<?php echo e($task->title); ?>">
                    <div class="flex justify-between items-start">
                        <h2 class="font-semibold text-lg"><?php echo e($task->title); ?></h2>
                        <div class="relative">
                            <button class="text-gray-500 text-sm" data-dropdown-toggle="task-<?php echo e($task->id); ?>-menu">⋮</button>
                            <div class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow" id="task-<?php echo e($task->id); ?>-menu">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100" data-modal-target="editTaskModal<?php echo e($task->id); ?>">
                                    ✏️ Modifier
                                </a>
                                <form method="POST" action="<?php echo e(route('tasks.destroy', $task->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 mt-2"><?php echo e($task->description); ?></p>
                    <div class="flex justify-between items-center mt-4 text-sm">
                        <span class="status-badge px-2 py-0.5 rounded-full text-white text-xs
                            <?php echo e($task->status === 'done' ? 'bg-green-500' : 'bg-gray-400'); ?>">
                            <?php echo e($task->status); ?>

                        </span>
                        <span class="text-gray-500">Échéance : <?php echo e(optional($task->due_date)->format('d/m/Y') ?? '—'); ?></span>
                    </div>
                    <div class="mt-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox"
                                   class="task-checkbox rounded text-indigo-600"
                                   data-task-id="<?php echo e($task->id); ?>"
                                <?php echo e($task->status === 'done' ? 'checked' : ''); ?>>
                            <span class="ml-2 text-sm">Marquer comme terminée</span>
                        </label>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-500 text-center col-span-full">
                    Aucune tâche. Ajoute-en une pour commencer !
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- MODALS -->
    <?php echo $__env->make('lists.partials.modal-new-task', ['taskList' => $taskList], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('lists.partials.modal-share-list', ['taskList' => $taskList], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const taskId = this.dataset.taskId;
                const isChecked = this.checked;

                fetch(`/tasks/${taskId}/status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LLCH1\OneDrive\Documents\TaskShare-main\resources\views/lists/show.blade.php ENDPATH**/ ?>