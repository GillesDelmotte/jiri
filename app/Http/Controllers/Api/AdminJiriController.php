<?php

namespace jiri\Http\Controllers\Api;

use Illuminate\Http\Request;
use jiri\Http\Controllers\Controller;
use jiri\Jiri;

class AdminJiriController extends Controller
{
    public function index(){
        $userJiries = Jiri::whereRaw('user_id =' . auth('api')->id() . ' and DATE_FORMAT(scheduled_on, "%Y%m%d") > DATE_FORMAT(NOW(), "%Y%m%d")')->get();
        return $userJiries;
    }
}
