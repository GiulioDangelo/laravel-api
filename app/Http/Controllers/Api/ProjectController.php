<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // request()->query('q','');
        // $projects = Project::where('title', 'like', '%' . $request->query('q') . '%')->paginate(10);

        $projects = Project::paginate(10);

        return response()->json($projects);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $projects = Project::where('slug', $slug)->firstOrFail();
        return response()->json($projects);
    }

    public function random(){
        $project = Project::inRandomOrder()->limit(9)->get();

        return response()->json($project);
    }
}