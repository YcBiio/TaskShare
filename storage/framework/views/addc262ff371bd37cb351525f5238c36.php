<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskShare - Bienvenue</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
<div class="container mx-auto px-4 py-16">
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-10 text-center">
        <h1 class="text-3xl font-bold mb-4 text-blue-600">Bienvenue sur TaskShare</h1>
        <p class="mb-6 text-gray-600">
            Organisez vos tâches, collaborez facilement avec d'autres utilisateurs, et suivez votre progression.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left mb-8">
            <div class="bg-gray-50 p-4 rounded">
                <h2 class="text-lg font-semibold text-blue-600 mb-2">🎯 Gestion des Tâches</h2>
                <ul class="text-sm text-gray-600 list-disc list-inside">
                    <li>Créez et organisez vos listes</li>
                    <li>Définissez priorités & échéances</li>
                    <li>Suivez votre avancement</li>
                </ul>
            </div>
            <div class="bg-gray-50 p-4 rounded">
                <h2 class="text-lg font-semibold text-blue-600 mb-2">🤝 Collaboration</h2>
                <ul class="text-sm text-gray-600 list-disc list-inside">
                    <li>Partagez avec vos amis</li>
                    <li>Attribuez des droits d'accès</li>
                    <li>Travaillez efficacement</li>
                </ul>
            </div>
        </div>
        <div class="flex justify-center gap-4">
            <a href="<?php echo e(route('login')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                Se connecter
            </a>
            <a href="<?php echo e(route('register')); ?>" class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-2 rounded">
                S'inscrire
            </a>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\Users\LLCH1\OneDrive\Documents\TaskShare-main\resources\views/welcome.blade.php ENDPATH**/ ?>