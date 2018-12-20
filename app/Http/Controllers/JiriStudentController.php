<?php

namespace jiri\Http\Controllers;

use Illuminate\Http\Request;
use jiri\Impression;
use jiri\Jiri;
use jiri\Student;

class JiriStudentController extends Controller
{
    public function show(Student $student)
    {
        $impression = Impression::where([['jiri_id', 1], ['student_id', $student->id], ['user_id', auth()->id()]])->get();
        $student = $student->load('implementationsForCurrentJiriWithProjectsAndScore');
        return view('students.one', ['student' => $student, 'impression' => $impression]);
    }
}
