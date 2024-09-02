<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ClassA;
use App\Services\ClassB;
use Illuminate\Http\Request;
use App\Classes\MathOperations;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {

        $projects = Project::get();
        return view('projects.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name'=>'required|string|max:100',
        ]);

        Project::create([

            'project_name' => $request->project_name,
            'status' => $request->status,

        ]);
        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'project_name'=>'required|string|max:100',
        ]);

        Project::findOrFail($id)->update([

            'project_name' => $request->project_name,
            'status' => $request->status,
        ]);

        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteProject($id)
    {
        $project = Project::find($id);
        $project->delete();

         return redirect()->route('project.index');

    }

    public function Report()
    {
        $projects = Project::with('task')->get();

        return view('projects.report', compact('projects'));
    }
}
