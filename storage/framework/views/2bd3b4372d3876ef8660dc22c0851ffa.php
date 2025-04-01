<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskShare - <?php echo $__env->yieldContent('title', 'Gestionnaire de Tâches Collaboratif'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
<!-- Navbar -->
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-xl font-bold text-indigo-600">
            TaskShare
        </a>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-700"><?php echo e(auth()->user()->name); ?></span>
            <div class="relative">
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-sm text-red-600 hover:underline">Déconnexion</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 p-6 hidden md:block">
        <nav class="space-y-2">
            <a href="<?php echo e(route('dashboard')); ?>" class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-gray-700'); ?>">
                🏠 Tableau de bord
            </a>
            <a href="<?php echo e(route('task-lists.index')); ?>" class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('task-lists.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-gray-700'); ?>">
                📋 Mes listes
            </a>
            <a href="<?php echo e(route('profile.edit')); ?>" class="block px-3 py-2 rounded hover:bg-gray-100 <?php echo e(request()->routeIs('profile.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-gray-700'); ?>">
                ⚙️ Profil
            </a>
        </nav>

        <hr class="my-4">

        <div class="space-y-2">
            <div class="text-xs text-gray-500 uppercase tracking-wide">Mes listes</div>
            <?php $__currentLoopData = auth()->user()->taskLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('task-lists.show', ['task_list' => $list->id])); ?>"
                   class="block px-3 py-1.5 rounded text-sm hover:bg-gray-100 <?php echo e(request()->route('task_list')?->id == $list->id ? 'bg-indigo-50 text-indigo-600 font-medium' : 'text-gray-700'); ?>">
                    <?php echo e($list->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            <a href="<?php echo e(route('task-lists.create')); ?>" class="block text-sm text-indigo-500 hover:underline mt-2">
                + Nouvelle liste
            </a>
        </div>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 p-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\LLCH1\OneDrive\Documents\TaskShare-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>