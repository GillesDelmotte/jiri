<?php

namespace jiri\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use jiri\User;

class TokenController extends Controller
{
    public function verifyToken($token)
    {
        $tokenParts = explode('$', $token);
        $jiri_id = $tokenParts[count($tokenParts) -1];

        $user = User::where('token', $token)->first();
        Auth::login($user, true);
        session(['jiri_id' => $jiri_id]);

        return Redirect::action('JiriController@show', $jiri_id);
    }
}
