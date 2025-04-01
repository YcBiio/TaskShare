<!-- Modal : Nouvelle tâche -->
<div id="newTaskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 items-center justify-center">
    <div class="bg-white w-full max-w-md rounded shadow-lg p-6 relative">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-red-500" data-modal-close="newTaskModal">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Nouvelle tâche</h2>
        <form action="<?php echo e(route('tasks.store', $taskList->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="task-title" class="block text-sm font-medium">Titre</label>
                <input type="text" id="task-title" name="title" required
                       class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div class="mb-4">
                <label for="task-description" class="block text-sm font-medium">Description</label>
                <textarea id="task-description" name="description" rows="3"
                          class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="task-priority" class="block text-sm font-medium">Priorité</label>
                    <select id="task-priority" name="priority" class="w-full mt-1 p-2 border rounded">
                        <option value="low">Basse</option>
                        <option value="medium" selected>Moyenne</option>
                        <option value="high">Haute</option>
                    </select>
                </div>
                <div>
                    <label for="task-due-date" class="block text-sm font-medium">Échéance</label>
                    <input type="date" id="task-due-date" name="due_date"
                           class="w-full mt-1 p-2 border rounded">
                </div>
            </div>
            <input type="hidden" name="status" value="todo">
            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200" data-modal-close="newTaskModal">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Créer
                </button>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\LLCH1\OneDrive\Documents\TaskShare-main\resources\views/lists/partials/modal-new-task.blade.php ENDPATH**/ ?>