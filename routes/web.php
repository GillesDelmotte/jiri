<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');

Auth::routes();

Route::get('/dashboard', 'dashboardController@index')->middleware('auth');

Route::post('/setModifyJiri', 'jiriController@modifyJiri')->middleware('auth');

Route::post('/modifyJiriBasicInfos', 'jiriController@update')->middleware('auth');

Route::post('/modifyImplementations', 'ImplementCOntroller@modifyImplementations')->middleware('auth');

Route::post('/addJudgesAndStudents', 'PeopleController@addJudgesAndStudents')->middleware('auth');

Route::post('/deletePeopleForJiri', 'PeopleController@deletePeopleForJiri')->middleware('auth');

Route::post('/addPeopleToDb', 'PeopleController@addPeopleToDb')->middleware('auth');

Route::post('/setModifyJudges', 'PeopleController@modifyJudges')->middleware('auth');

Route::post('/setModifyStudents', 'StudentController@modifyStudents')->middleware('auth');

Route::post('/setModifyProjects', 'ProjectController@modifyProjects')->middleware('auth');

Route::get('/dashboardUser', 'dashboardController@dashboardUser')->middleware('auth');

Route::get('/dashboardJiri', 'dashboardController@dashboardJiri')->middleware('auth');

Route::post('/addJudges', 'PeopleController@storeUser')->middleware('auth');

Route::post('/addStudents', 'PeopleController@storeStudent')->middleware('auth');

Route::post('/addPeopleStudents', 'PeopleController@storePeopleStudents')->middleware('auth');

Route::post('/addProject', 'ProjectController@store')->middleware('auth');

Route::post('/createImplementation', 'ImplementController@store')->middleware('auth');

Route::get('/authenticated-user', 'AuthenticatedUserController@fetch');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('students', 'StudentController')->middleware('auth');

Route::get('/student/{student}', 'JiriStudentController@show')->middleware('auth');

Route::get('/student/{student}/project/{project}', 'ProjectController@show')->middleware('auth');

Route::resource('jiri', 'JiriController')->middleware('auth');

Route::post('/deleteJury', 'JiriController@destroy')->middleware('auth');

Route::post('/startJiri', 'JiriController@startJiri')->middleware('auth');

Route::post('/stopJiri', 'JiriController@stopJiri')->middleware('auth');

Route::resource('score', 'ScoreController')->middleware('auth');

Route::resource('people', 'PeopleController')->middleware('auth');

Route::resource('impression', 'ImpressionController')->middleware('auth');

Route::get('/token/{token}', 'TokenController@verifyToken');
