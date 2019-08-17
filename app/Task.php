<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            $task->project->recordActivity('task_created');

            // Activity::create([
            //     'project_id' => $task->project->id,
            //     'description' => 'created_task'
            // ]); Moved to the project model App\Project.php
        });

        // static::updated(function ($task) {
        //     if (! $task->completed) return;

        //     $task->project->recordActivity('completed_task');

            // Activity::create([
                //     'project_id' => $task->project->id,
                //     'description' => 'completed_task'
                // ]); Moved to the project model App\Project.php
            // });
        }

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->project->recordActivity('task_completed');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
