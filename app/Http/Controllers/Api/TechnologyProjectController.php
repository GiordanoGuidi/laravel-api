<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyProjectController extends Controller
{
    public function __invoke(string $id)
    {
        $technology = Technology::whereId($id);
        if (!$technology) return response(null, 404);
        $projects = $technology->projects;

        return response()->json($projects);
    }
}
