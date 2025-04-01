<?php $__env->startSection('title', 'Mes listes'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Mes listes</h1>
            <a href="<?php echo e(route('task-lists.create')); ?>"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm">
                + Nouvelle liste
            </a>
        </div>

        <?php if($lists->count() === 0 && $sharedLists->count() === 0): ?>
            <p class="text-gray-500 text-center">Tu n’as encore aucune liste de tâches.</p>
        <?php endif; ?>

        <!-- Mes listes -->
        <?php if($lists->count()): ?>
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">📋 Mes listes</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded shadow p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-lg"><?php echo e($list->name); ?></h3>
                                <form action="<?php echo e(route('task-lists.destroy', $list->id)); ?>" method="POST"
                                      onsubmit="return confirm('Supprimer cette liste ?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:underline text-sm">🗑️</button>
                                </form>
                            </div>
                            <p class="text-sm text-gray-500 mb-2">
                                <?php echo e($list->tasks_count); ?> tâche<?php echo e($list->tasks_count === 1 ? '' : 's'); ?>

                            </p>
                            <div class="w-full h-2 bg-gray-200 rounded mb-2">
                                <div class="h-2 bg-green-500 rounded" style="width: <?php echo e($list->completion_percentage); ?>%"></div>
                            </div>
                            <p class="text-xs text-gray-500"><?php echo e($list->completion_percentage); ?>% complété</p>
                            <a href="<?php echo e(route('task-lists.show', $list->id)); ?>"
                               class="mt-3 inline-block text-sm text-indigo-600 hover:underline font-medium">
                                ➤ Voir la liste
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Partagées avec moi -->
        <?php if($sharedLists->count()): ?>
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4">🤝 Partagées avec moi</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $sharedLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded shadow p-4">
                            <h3 class="font-semibold text-lg mb-1"><?php echo e($list->name); ?></h3>
                            <p class="text-sm text-gray-500 mb-2">
                                <?php echo e($list->tasks_count); ?> tâche<?php echo e($list->tasks_count === 1 ? '' : 's'); ?> ·
                                <?php echo e($list->completion_percentage); ?>% complété
                            </p>
                            <div class="w-full h-2 bg-gray-200 rounded mb-2">
                                <div class="h-2 bg-green-500 rounded" style="width: <?php echo e($list->completion_percentage); ?>%"></div>
                            </div>
                            <a href="<?php echo e(route('task-lists.show', $list->id)); ?>"
                               class="mt-2 inline-block text-sm text-indigo-600 hover:underline font-medium">
                                ➤ Accéder à la liste
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LLCH1\OneDrive\Documents\TaskShare-main\resources\views/lists/index.blade.php ENDPATH**/ ?>