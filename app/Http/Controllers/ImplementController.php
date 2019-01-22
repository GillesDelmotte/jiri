<?php

namespace jiri\Http\Controllers;

use jiri\Implement;
use Illuminate\Http\Request;
use jiri\Impression;
use jiri\Jiri;
use jiri\Project;
use jiri\Student;

class ImplementController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jiri = Jiri::where('user_id', auth()->id())->orderBy('created_at', 'desc')->first();
        foreach ($request['implementations'] as $implementation){
            $project = Project::where('name', $implementation['project'])->first();
            Implement::create([
               'student_id' => $implementation['student'],
               'project_id' => $project->id,
               'jiri_id' => $jiri->id
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \jiri\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function show(Implement $implement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \jiri\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function edit(Implement $implement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \jiri\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Implement $implement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\Implement  $implement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Implement $implement)
    {
        //
    }

    public function modifyImplementations(Request $request)
    {
        $oldImplementations = Implement::where('jiri_id', $request['id'])->get();
        foreach ($oldImplementations as $implementation){
            $implementation->delete();
        }

        foreach ($request['newImplementations'] as $implementation){

            $student = Student::where('email', $implementation['student']['email'])->first();
            $project = Project::where('name', $implementation['project']['name'])->first();

            if($project === null){
                $newProject = Project::create([
                    'name' => $implementation['project']['name'],
                    'description' => $implementation['project']['description']
                ]);

                Implement::create([
                    'student_id' => $student['id'],
                    'project_id' => $newProject['id'],
                    'jiri_id' => $request['id']
                ]);
            }else{
                Implement::create([
                    'student_id' => $student['id'],
                    'project_id' => $project['id'],
                    'jiri_id' => $request['id']
                ]);
            }

        }

    }
}
