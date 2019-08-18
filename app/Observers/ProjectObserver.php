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

    public function updating(Project $project)
    {
        $project->old = $project->getOriginal();
    }

    /**
     * Handle the project "updated" event.
     */
    public function updated(Project $project)
    {
        $project->recordActivity('project_updated');
    }
}
