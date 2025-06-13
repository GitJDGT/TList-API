<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'image',
        'status',
    ];

    /**
     * Each task belongs to a task list.
     */
    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }
}
