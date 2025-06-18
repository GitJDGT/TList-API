<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    /** @use HasFactory<\Database\Factories\TaskListFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
    ];

    /**
     * Each task list belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Each task list can have many tasks.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
