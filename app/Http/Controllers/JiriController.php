<?php

namespace jiri\Http\Controllers;

use jiri\Jiri;
use Illuminate\Http\Request;

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
        //
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
    public function update(Request $request, Jiri $jiri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\Jiri  $jiries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jiri $jiri)
    {
        //
    }
}
