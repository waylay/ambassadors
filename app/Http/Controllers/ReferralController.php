<?php

namespace App\Http\Controllers;

use App\Referral;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Ambassador;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Laratables::recordsOf(Referral::class);
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
        $validatedData = $request->validate([
            'ambassador_name' => ['required', 'string', 'max:255'],
            'ambassador_email' => ['required', 'string', 'email', 'max:255'],
            'ambassador_phone' => ['required', 'string', 'max:255'],
            'referral_name' => ['required', 'string', 'max:255'],
            'referral_email' => ['required', 'string', 'email', 'max:255', 'unique:referrals,email'],
            'referral_phone' => ['required', 'string', 'max:255'],
            'referral_job' => ['required', 'string', 'max:255'],
            'referral_location' => ['required', 'string', 'max:255'],
        ]);


        $ambassador = Ambassador::firstOrCreate(
            [
                'email' => $validatedData['ambassador_email']
            ],
            [
                'name' => $validatedData['ambassador_name'],
                'phone' => $validatedData['ambassador_phone']
            ]
        );

        Referral::create([
            'ambassador_id' => $ambassador->id,
            'name'          => $validatedData['referral_name'],
            'email'         => $validatedData['referral_email'],
            'phone'         => $validatedData['referral_phone'],
            'job'           => $validatedData['referral_job'],
            'location'      => $validatedData['referral_location'],
        ]);

        // send mail

        return redirect()->back()->with('success', $validatedData['referral_name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        //
    }
}
