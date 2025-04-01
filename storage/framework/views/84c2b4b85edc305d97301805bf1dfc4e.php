<?php $__env->startSection('title', 'Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Bienvenue, <?php echo e(auth()->user()->name); ?></h1>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-indigo-500 text-white p-6 rounded shadow">
                <h2 class="text-sm">Total des tâches</h2>
                <p class="text-3xl font-bold"><?php echo e($totalTasks); ?></p>
            </div>
            <div class="bg-green-500 text-white p-6 rounded shadow">
                <h2 class="text-sm">Tâches complétées</h2>
                <p class="text-3xl font-bold"><?php echo e($completedTasks); ?></p>
            </div>
            <div class="bg-yellow-400 text-gray-800 p-6 rounded shadow">
                <h2 class="text-sm">Tâches à faire aujourd'hui</h2>
                <p class="text-3xl font-bold"><?php echo e($todayTasks); ?></p>
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
                    <?php $__empty_1 = true; $__currentLoopData = $upcomingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="font-medium"><?php echo e($task->title); ?></p>
                                <p class="text-sm text-gray-500"><?php echo e($task->taskList?->name ?? 'Liste inconnue'); ?></p>
                            </div>
                            <div class="text-sm text-right">
                                <span class="inline-block px-2 py-1 text-white rounded
                                    <?php echo e($task->status === 'done' ? 'bg-green-500' : 'bg-gray-400'); ?>">
                                    <?php echo e($task->status); ?>

                                </span>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo e(optional($task->due_date)->format('d/m/Y') ?? '—'); ?>

                                </p>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="text-gray-500 py-3">Aucune tâche à venir</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Listes -->
            <div class="bg-white p-4 rounded shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Mes listes</h3>
                    <a href="<?php echo e(route('task-lists.create')); ?>" class="text-sm text-indigo-600 hover:underline">
                        + Ajouter
                    </a>
                </div>
                <ul class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $taskLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li>
                            <a href="<?php echo e(route('task-lists.show', $list->id)); ?>" class="text-gray-800 font-medium hover:text-indigo-600">
                                <?php echo e($list->name); ?>

                            </a>
                            <div class="w-full h-2 bg-gray-200 rounded mt-1">
                                <div class="h-2 <?php echo e($list->completion_percentage > 0 ? 'bg-green-500' : 'bg-gray-400'); ?> rounded"
                                     style="width: <?php echo e($list->completion_percentage); ?>%"></div>
                            </div>
                            <p class="text-xs text-gray-500"><?php echo e($list->completion_percentage); ?>% complété</p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="text-gray-500">Aucune liste créée</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LLCH1\OneDrive\Documents\TaskShare-main\resources\views/dashboard.blade.php ENDPATH**/ ?>