<?php

namespace App\Http\Controllers;

use App\Ambassador;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;

class AmbassadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Laratables::recordsOf(Ambassador::class);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ambassador  $ambassador
     * @return \Illuminate\Http\Response
     */
    public function show(Ambassador $ambassador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ambassador  $ambassador
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambassador $ambassador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ambassador  $ambassador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambassador $ambassador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ambassador  $ambassador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambassador $ambassador)
    {
        //
    }
}
