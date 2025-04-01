document.addEventListener('DOMContentLoaded', () => {
    setupTaskStatusToggle();
    setupFilters();
    setupSorting();
    setupModals();
});

// ✅ Gestion du changement de statut d'une tâche (checkbox)
function setupTaskStatusToggle() {
    const checkboxes = document.querySelectorAll('.task-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const taskId = checkbox.dataset.taskId;
            const status = checkbox.checked ? 'completed' : 'pending';

            fetch(`/tasks/${taskId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const card = checkbox.closest('.task-card-container');
                        const badge = card.querySelector('.status-badge');

                        badge.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-gray-400');
                        badge.classList.add(status === 'completed' ? 'bg-green-500' : 'bg-gray-400');
                        badge.textContent = status;
                        card.classList.toggle('opacity-70', status === 'completed');
                    }
                });
        });
    });
}

// ✅ Gestion des filtres (statut, priorité, date)
function setupFilters() {
    const filterItems = document.querySelectorAll('.filter-item');

    filterItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const type = item.dataset.filter;
            const value = item.dataset.value;
            const cards = document.querySelectorAll('.task-card-container');
            const today = new Date();

            cards.forEach(card => {
                const date = new Date(card.dataset.date);
                let show = false;

                if (value === 'all') {
                    show = true;
                } else if (type === 'status' && card.dataset.status === value) {
                    show = true;
                } else if (type === 'priority' && card.dataset.priority === value) {
                    show = true;
                } else if (type === 'date') {
                    if (value === 'today') {
                        show = date.toDateString() === today.toDateString();
                    } else if (value === 'week') {
                        const weekStart = new Date(today);
                        weekStart.setDate(today.getDate() - today.getDay());
                        const weekEnd = new Date(weekStart);
                        weekEnd.setDate(weekStart.getDate() + 6);
                        show = date >= weekStart && date <= weekEnd;
                    } else if (value === 'month') {
                        show = date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear();
                    }
                }

                card.style.display = show ? 'block' : 'none';
            });

            document.getElementById('taskFilterDropdown').innerHTML =
                `<span class="font-medium">🔍 ${item.textContent.trim()}</span>`;
        });
    });
}

// ✅ Tri des tâches (date, priorité, nom)
function setupSorting() {
    const sortItems = document.querySelectorAll('.sort-item');
    const priorityValue = { high: 3, medium: 2, low: 1 };

    sortItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const sort = item.dataset.sort;
            const container = document.querySelector('.grid');
            const cards = Array.from(document.querySelectorAll('.task-card-container'));

            cards.sort((a, b) => {
                if (sort.includes('date')) {
                    const da = new Date(a.dataset.date);
                    const db = new Date(b.dataset.date);
                    return sort === 'date-asc' ? da - db : db - da;
                } else if (sort.includes('priority')) {
                    const pa = priorityValue[a.dataset.priority];
                    const pb = priorityValue[b.dataset.priority];
                    return sort === 'priority-asc' ? pa - pb : pb - pa;
                } else if (sort.includes('name')) {
                    const na = a.dataset.name;
                    const nb = b.dataset.name;
                    return sort === 'name-asc' ? na.localeCompare(nb) : nb.localeCompare(na);
                }
            });

            cards.forEach(card => container.appendChild(card));

            document.getElementById('taskSortDropdown').innerHTML =
                `<span class="font-medium">🔽 ${item.textContent.trim()}</span>`;
        });
    });
}

// ✅ Gestion des modals (ouvrir/fermer avec data-modal-target / data-modal-close)
function setupModals() {
    document.querySelectorAll('[data-modal-target]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-modal-target');
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-modal-close');
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
}
