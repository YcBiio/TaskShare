<?php

namespace App\Providers;

use App\Models\TaskList;
use App\Policies\TaskListPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mappe les modèles avec leurs policies.
     */
    protected $policies = [
        TaskList::class => TaskListPolicy::class,
    ];

    /**
     * Enregistre les services d'autorisation.
     */
    public function boot(): void
    {
        //
    }
}
