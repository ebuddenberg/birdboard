<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('Projects.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
            ]);

        // $attributes['owner_id'] = auth()->id(); //This is the same as below but below is refactored

        // Project::create($attributes); //Creating the project with the old code commented above. The refactored line takes care of it already

        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }
}
