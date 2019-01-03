<?php

namespace jiri\Http\Controllers\Api;

use Illuminate\Http\Request;
use jiri\Http\Controllers\Controller;
use jiri\User;

class AdminUserController extends Controller
{
    public function index(){
        $allUsers = User::All();
        return $allUsers;
    }
}
