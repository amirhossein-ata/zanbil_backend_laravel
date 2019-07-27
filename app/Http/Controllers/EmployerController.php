<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Http\Request;
use App\Http\Resources\EmployerCollection;
use App\Http\Resources\Employer as EmployerResource;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EmployerCollection(Employer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'business_id' => 'required|integer',

        ]);
        $employer = new Employer([
            'user_id' => $request->user_id,
            'business_id' => $request->business_id
        ]);

        $employer->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        return new EmployerResource($employer);
    }

    public function update(Request $request, Employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        //
    }
}
