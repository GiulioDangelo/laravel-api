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
        $searchStr = $request->query('q', '');
        $type = $request->query('category', false);
        

        // $projects = Project::with('type', 'technologies')->where('title', 'LIKE', "%{$searchStr}%")->paginate(10);

        $projects = Project::with('type', 'technologies');

        if($searchStr){
            $projects = $projects->where('title', 'LIKE', "%{$searchStr}%");
        }

        if($type){
            $projects = $projects->where('type_id', $type);
        }

        $projects = $projects->paginate(10);

        // $projects = Project::paginate(10);

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