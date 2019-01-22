<?php

namespace jiri\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use jiri\Jiri;
use jiri\People;
use Illuminate\Http\Request;
use jiri\Student;
use jiri\User;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jiri = Jiri::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at','desc')->first();

        foreach($request['allJudges'] as $judge) {
                $user = User::where('email', $judge['email'])->first();
                People::create([
                    'jiri_id' => $jiri->id,
                    'person_id' => $user->id,
                    'person_type' => 'jiri\User'
                ]);
            }
    }

    protected function storePeopleStudents(Request $request){

        $jiri = Jiri::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at','desc')->first();

        foreach($request['allStudents'] as $student){
            $toto = Student::where('email', $student['email'])->first();
            People::create([
                'jiri_id' => $jiri->id,
                'person_id' => $toto->id,
                'person_type' => 'jiri\Student'
            ]);
        }
    }

    protected function storeUser(Request $request)
    {
        foreach($request['allJudges'] as $judge){
            User::create([
                'name' => $judge['name'],
                'email' => $judge['email'],
                'password' => Hash::make('azerty'),
                'api_token' => str_random(60)
            ]);
        }
    }

    protected function storeStudent(Request $request)
    {
        foreach($request['allStudents'] as $student){
            Student::create([
                'name' => $student['name'],
                'email' => $student['email'],
            ]);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \jiri\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \jiri\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \jiri\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }

    public function modifyJudges(Request $request)
    {
        $people = People::where('jiri_id', $request['id'])->where('person_type', 'Jiri\User')->get();

        $judges = [];

        foreach ($people as $person){
            $judge = User::where('id', $person->person_id)->first();
            $judges[] = $judge;
        }

        return $judges;
    }

    public function addJudgesAndStudents(Request $request)
    {
        foreach($request['newStudents'] as $student){
            Student::create([
                'name' => $student['name'],
                'email' => $student['email'],
            ]);
        }

        foreach($request['newJudges'] as $judge){
           User::create([
                'name' => $judge['name'],
                'email' => $judge['email'],
                'password' => Hash::make('azerty'),
                'api_token' => str_random(60)
            ]);
        }
    }



    public function deletePeopleForJiri(Request $request)
    {
        foreach ($request['judges'] as $judge){
            $user = People::where('jiri_id', $request['id'])->where('person_type', 'Jiri\User')->where('person_id', $judge['id'])->first();
            if($user !== null){
                $user->delete();
            }
        }

        foreach ($request['students'] as $student){
            $stud = People::where('jiri_id', $request['id'])->where('person_type', 'Jiri\Student')->where('person_id', $student['id'])->first();
            if($stud !== null){
                $stud->delete();
            }
        }
    }

    public function addPeopleToDb(Request $request)
    {
        $people = People::where('jiri_id', $request['id'])->get();
        foreach($people as $person){
            $person->delete();
        }

        foreach($request['students'] as $student){
            $stud = Student::where('email', $student['email'])->first();
            People::create([
               'jiri_id' => $request['id'],
               'person_id' => $stud['id'],
               'person_type' => 'Jiri\Student'
            ]);
        }

        foreach($request['judges'] as $judge){
            $user = User::where('email', $judge['email'])->first();
            People::create([
               'jiri_id' => $request['id'],
               'person_id' => $user['id'],
               'person_type' => 'Jiri\User'
            ]);
        }
    }
}
