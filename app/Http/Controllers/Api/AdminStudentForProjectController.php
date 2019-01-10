<?php

namespace jiri\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jiri\Http\Controllers\Controller;
use jiri\Jiri;
use jiri\People;
use jiri\Student;

class AdminStudentForProjectController extends Controller
{
    public function index(){
        $jiri = Jiri::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at','desc')->first();
        $people = People::where('jiri_id', $jiri->id)->where('person_type', 'Jiri\Student')->get();
        $studentForCreateJiri = [];
        foreach ($people as $person){
            $student = Student::where('id', $person->person_id)->first();
            array_push($studentForCreateJiri, $student);
        }
        return $studentForCreateJiri;
    }
}
