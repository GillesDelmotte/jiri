<?php

namespace jiri\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedUserController extends Controller
{
    public function fetch(){
        return auth()->user();
    }
}
