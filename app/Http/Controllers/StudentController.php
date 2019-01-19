<?php

namespace jiri\Http\Controllers;

use jiri\People;
use jiri\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \jiri\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \jiri\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \jiri\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function modifyStudents(Request $request)
    {
        $people = People::where('jiri_id', $request['id'])->where('person_type', 'Jiri\Student')->get();

        $students=[];

        foreach($people as $person){
            $student = Student::where('id', $person->person_id)->first();
            $students[] = $student;
        }


        return $students;
    }
}
