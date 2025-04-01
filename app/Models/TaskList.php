<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    // Champs accessibles par l'attribution de masse
    protected $fillable = ['name'];

    // Propriétaire de la liste
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Tâches contenues dans la liste
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Utilisateurs avec qui la liste est partagée
    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'task_list_user')
            ->withPivot('can_edit')
            ->withTimestamps();
    }
}
