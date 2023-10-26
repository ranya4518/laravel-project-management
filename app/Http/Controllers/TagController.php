<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $tag=Tag::all();
    return response()->json($tag);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validateData=$request->validate([
        'name'=>'required|max:15'
    ]);
    $tag=Tag::create($request->all());
    return response()->json($tag);
    }
    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
    return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
     $validateData=$request->validate([
        'name'=>'required|max:15'
    ]);
     $tag->update($request->all());
     return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
    $tag->delete();
    return response()->json($tag);
    }
}
