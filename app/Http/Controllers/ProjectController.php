<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $projects=Project::all();
    return response()->json($projects);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validateData=$request->validate([
        'title'=>'required|max:20',
        'description'=>'required|string|max:200',
        'user_id'=>'required|integer'
    ]);
     $projects=Project::create($request->all());
      return response()->json($projects);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
     $project->find($project);
     return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
      $validateData=$request->validate([
        'title'=>'required|max:20',
        'description'=>'required|string|max:200',
        'user_id'=>'required|integer'
    ]);
     $project->update($request->all());
     return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
    $project->delete();
    return response()->json($project);
    }
}
