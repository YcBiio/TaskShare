<!-- Modal : Partager la liste -->
<div id="shareListModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 items-center justify-center">
    <div class="bg-white w-full max-w-md rounded shadow-lg p-6 relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-red-500" data-modal-close="shareListModal">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Partager la liste</h2>
        <form action="<?php echo e(route('task-lists.share', $taskList->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="share-email" class="block text-sm font-medium">Adresse email</label>
                <input type="email" id="share-email" name="email" required
                       class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <small class="text-gray-500">L’utilisateur doit avoir un compte.</small>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Permissions</label>
                <div class="mt-1 space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="permission" value="read" checked class="text-indigo-600">
                        <span class="ml-2 text-sm">Lecture seule</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="permission" value="edit" class="text-indigo-600">
                        <span class="ml-2 text-sm">Peut modifier</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200" data-modal-close="shareListModal">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Partager
                </button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\LLCH1\OneDrive\Documents\TaskShare-main\resources\views/lists/partials/modal-share-list.blade.php ENDPATH**/ ?>