<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::with('project')->get();
        return view('task.list', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::where('status',1)->get();
        return view('task.create',compact('projects'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(([
            'task_name' =>'required|string|max:100'
        ]));

        Task::create([

            'task_name' => $request->task_name,
            'project_id' => $request->project_id,
            'status' => $request->status,

        ]);

        return redirect()->route('task.index');

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
        $task = Task::findOrFail($id);
        $projects = Project::where('status',1)->get();

        return view('task.edit', compact('task','projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task_name' =>'required|string|max:100',
            'description' =>'required|string|max:100',

        ]);

        Task::findOrFail($id)->update([

            'task_name' => $request->task_name,
            'project_id' => $request->project_id,
            'status' => $request->status,
            'description' => $request->description,
            'hours' => $request->hours,
            'date' => $request->date,
        ]);

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function DeleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();

         return redirect()->route('task.index');

    }


    public function Time()
    {
        $task = Task::with('project')->get();

        return view('task.time', compact('task'));
    }
}
