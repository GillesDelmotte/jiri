<?php

namespace jiri\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use jiri\Http\Requests\StoreScore;
use jiri\Implement;
use jiri\Project;
use jiri\Score;
use Illuminate\Http\Request;
use jiri\Student;

class ScoreController extends Controller
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
    public function store(StoreScore $request)
    {
        $validatedData = $request->all();
        Score::create($validatedData);
        $implementation = Implement::find($request->get('implement_id'));
        $scores = Score::where('implement_id', $request['implement_id'])->get();
        $result = null;
        $divisor = null;
        foreach ($scores as $score){
            $result += $score->score;
            $divisor++;
        }
        $implementation->result = $result/$divisor;
        $implementation->save();
        $student = $implementation->student;

        return \Redirect::action('JiriStudentController@show', $student->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \jiri\Score $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \jiri\Score $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        $implementation = Implement::find($score->implement_id);
        $project = Project::find($implementation->project_id);
        $student = Student::find($implementation->student_id)->load(['implementationsForCurrentJiriWithProjects'
        => function($q) use($project){
            $q->where('project_id', $project->id);
        }]);

        return view('project.edit', ['score' => $score, 'student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \jiri\Score $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        $score->update($request->all());
        $implementation = Implement::find($score->implement_id);

        $scores = Score::where('implement_id', $score->implement_id)->get();
        $result = null;
        $divisor = null;
        foreach ($scores as $score){
            $result += $score->score;
            $divisor++;
        }
        $implementation->result = $result/$divisor;
        $implementation->save();

        $student = $implementation->student;
        return \Redirect::action('JiriStudentController@show', $student->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\Score $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
