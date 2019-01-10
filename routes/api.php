<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->resource('jiri', 'Api\AdminJiriController');

Route::middleware('auth:api')->resource('user', 'Api\AdminUserController');

Route::middleware('auth:api')->resource('student', 'Api\AdminStudentController');

Route::middleware('auth:api')->resource('project', 'Api\AdminProjectController');

Route::middleware('auth:api')->resource('studentsForProjects', 'Api\AdminStudentForProjectController');
