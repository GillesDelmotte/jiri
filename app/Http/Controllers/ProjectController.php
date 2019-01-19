<?php

namespace jiri\Http\Controllers;

use jiri\Implement;
use jiri\Project;
use Illuminate\Http\Request;
use jiri\Student;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request['allProjects'] as $project){
            Project::create([
                'name' => $project['name'],
                'description' => $project['description']
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \jiri\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, Project $project)
    {
        $student = $student->load(['implementationsForCurrentJiriWithProjects' => function ($q) use ($project) {
            $q->where('project_id', $project->id);
        }]);
        return view('project.one', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \jiri\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \jiri\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function modifyProjects(Request $request)
    {
        $implementations = Implement::where('jiri_id', $request['id'])->distinct()->get(['project_id']);

        $projects = [];

        foreach ($implementations as $implementation){
            $project = Project::where('id', $implementation->project_id)->first();
            $projects[] = $project;
        }

        return $projects;
    }
}
