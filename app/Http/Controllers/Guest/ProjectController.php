<?php

namespace App\Http\Controllers\Guest;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show(String $slug)
    {
        $project = Project::whereSlug($slug)->first();
        if (!$project) abort(404);
        return view('guest.projects.show', compact('project'));
    }
}
