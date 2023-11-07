<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $tasks=Task::all();
    return response()->json($tasks);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'name'=>'required|max:15',
            'completed'=>'required|integer|min:0|max:1',
            'project_id'=>'required|integer'
        ]);
    $task=Task::create($request->all());
    return response()->json($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
    return new TaskResource($task);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validateData=$request->validate([
            'name'=>'required|max:18',
            'completed'=>'required|integer|min:0|max:1',
            'project_id'=>'required|integer'
        ]);
    $task->update($request->all());
    return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
    $task->delete();
    return response()->json($task);
    }

 
    public function delete(Task $task,Tag $tag){
       $task->Tags()->detach($tag);
        return $task;
    }
   
  
    public function insert(Task $task){
     $task->Tags()->attach([4]);
     return response()->json($task);
    }

}
