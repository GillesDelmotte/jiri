<?php

namespace jiri\Http\Controllers;

use Illuminate\Http\Request;
use jiri\Jiri;
use jiri\People;
use jiri\Student;
use jiri\User;

class DashboardController extends Controller
{
    public function index(){
        $people = People::where('jiri_id', session('jiri_id'))->where('person_type', 'Jiri\Student')->get();

        $students = [];
        foreach ($people as $person){
            $currentPerson = Student::where('id', $person->person_id)->first();
            $students[] = $currentPerson;
        }
        $allstudent = [];
        foreach ($students as $student){
            $oneStudent = $student->load('ImplementationsForCurrentJiriWithProjectsAndScores');
            $allstudent[] = $oneStudent;
        }

        return $allstudent;
    }

    public function dashboardUser(){
        $people = People::where('jiri_id', session('jiri_id'))->where('person_type', 'Jiri\User')->get();
        $users = [];
        foreach ($people as $person){
            $currentPerson = User::where('id', $person->person_id)->first();
            $users[] = $currentPerson;
        }

        return $users;

    }

    public function dashboardJiri(){
        $jiri = Jiri::where('id', session('jiri_id'))->first();

        return $jiri;
    }
}
