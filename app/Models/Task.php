<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Champs autorisés à être remplis automatiquement
    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'status',
    ];

    // Casts pour convertir automatiquement certains champs
    protected $casts = [
        'due_date' => 'datetime',
    ];

    // Relation avec la liste de tâches (chaque tâche appartient à une liste)
    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }
}
