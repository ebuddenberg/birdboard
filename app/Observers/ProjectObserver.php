<?php

namespace App\Observers;

use App\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     */
    public function created(Project $project)
    {
        $project->recordActivity('project_created');
    }

    /**
     * Handle the project "updated" event.
     */
    public function updated(Project $project)
    {
        $project->recordActivity('project_updated');
    }
}
