<?php

namespace jiri\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use jiri\Implement;
use jiri\Jiri;
use Illuminate\Http\Request;
use jiri\Mail\JiriEnded;
use jiri\Mail\JiriStarted;
use jiri\People;
use jiri\Student;

class JiriController extends Controller
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
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request['name'];
        $date = $request['date'];
        $time = $request['time'];
        $scheduled_on = $date . ' ' . $time;
        Jiri::create(['name' => $name, 'user_id' => auth()->id(),'scheduled_on' => $scheduled_on]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \jiri\Jiri  $jiries
     * @return \Illuminate\Http\Response
     */
    public function show(Jiri $jiri)
    {
        $currentJiri = $jiri->load('students');
        return view('students.all', ['currentJiri' => $currentJiri]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \jiri\Jiri  $jiries
     * @return \Illuminate\Http\Response
     */
    public function edit(Jiri $jiri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \jiri\Jiri  $jiries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $jiri = Jiri::where('id', $request['id'])->first();
        $jiri->name = $request['jiriName'];
        if($request['jiriDate'] === null){
            $pieces = explode(" ", $jiri->scheduled_on);
            $jiri->scheduled_on = $pieces[0] . " " . $request['jiriTime'];
        }else{
            $jiri->scheduled_on = $request['jiriDate'] . " " . $request['jiriTime'];
        }

        $jiri->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\Jiri  $jiries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jiri $jiri, Request $request)
    {
        $id = $request['id'];

        /*
         * delete jury
         */
        $jiri = Jiri::where('id', $id)->first();
        $jiri->delete();

        /*
         * delete people
         */
        $people = People::where('jiri_id', $id)->get();
        foreach ($people as $person){
            $person->delete();
        }

        /*
         * delete implementations
         */
        $implementations = Implement::where('jiri_id', $id)->get();
        foreach ($implementations as $implementation){
            $implementation->delete();
        }

    }

    public function startJiri(Request $request)
    {
        $id = $request['id'];
        $jiri = Jiri::findOrFail($id)->load('judges');
        $jiri->is_active = true;
        $jiri->save();

        foreach ($jiri->judges as $judge){
            $judge->token = time() . '$' . $judge->id . '$' . $jiri->id;
            $judge->save();
            Mail::to($judge->email)->send(new JiriStarted($judge, $jiri));
        }
        $request->session()->put('jiri_id', $id);
    }

    public function stopJiri(Request $request)
    {
        $id = $request['id'];
        $jiri = Jiri::findOrFail($id)->load('judges');
        $jiri->is_active = false;
        $jiri->save();

        foreach($jiri->judges as $judge){
            $judge->token = '';
            $judge->save();
            Mail::to($judge->email)->send(new JiriEnded($judge, $jiri));
        }

        $request->session()->forget('jiri_id');
    }

    public function modifyJiri(Request $request)
    {
        $jiri = Jiri::where('id', $request['id'])->first();

        return $jiri;
    }

}
