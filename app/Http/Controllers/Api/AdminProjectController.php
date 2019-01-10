<?php

namespace jiri\Http\Controllers\Api;

use jiri\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jiri\Project;

class AdminProjectController extends Controller
{
    public function index(){
        $allProjects = Project::all();
        return $allProjects;
    }
}
