<?php

namespace jiri\Http\Controllers;

use jiri\Http\Requests\StoreImpression;
use jiri\Impression;
use Illuminate\Http\Request;

class ImpressionController extends Controller
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
    public function store(StoreImpression $request)
    {
        $validatedData = $request->all();
        Impression::create($validatedData);
        session()->flash('message', 'Votre note d‘appréciation à bien été enregistée');
        return \Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \jiri\Impression  $impression
     * @return \Illuminate\Http\Response
     */
    public function show(Impression $impression)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \jiri\Impression  $impression
     * @return \Illuminate\Http\Response
     */
    public function edit(Impression $impression)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \jiri\Impression  $impression
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impression $impression)
    {
        $impression->update($request->all());
        session()->flash('message', 'Votre note d‘appréciation à bien été modifiée');
        return \Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \jiri\Impression  $impression
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impression $impression)
    {
        //
    }
}
