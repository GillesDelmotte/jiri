<?php

namespace jiri\Http\Controllers;

use Illuminate\Http\Request;
use jiri\Student;

class DashboardController extends Controller
{
    public function index(Student $student){
        return $students = Student::All()->load(['implementationsForCurrentJiriWithProjects']);
        return view('admin.dashboard', ['students' => $student]);
    }
}
