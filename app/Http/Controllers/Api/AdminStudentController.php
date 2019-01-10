<?php

namespace jiri\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use jiri\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jiri\Jiri;
use jiri\Student;

class AdminStudentController extends Controller
{
    public function index(){
        $allStudents = Student::All();
        return $allStudents;
    }
}
