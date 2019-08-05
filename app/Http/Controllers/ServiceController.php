<?php

namespace App\Http\Controllers;

use App\Timetable;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Resources\Service as ServiceResource;
use App\Http\Resources\ServiceCollection;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->employerID === null){
            return new ServiceCollection(Service::all());
        }
        return new ServiceCollection(Service::all()->where('employer_id', $request->employerID));
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
            'name' => 'required|string',
            'description' => 'string',
            'business_id' => 'required|integer',
            'employer_id' => 'required|integer',
            'address' => 'required|string',
            'start_day' => 'required|string',
            'start_middle_rest' => 'required|string',
            'end_middle_rest' => 'required|string',
            'end_day' => 'required|string',
            'time_length' => 'required|integer',
            'gap_length' => 'required|integer'
        ]);
        $service = new Service([
            'name' => $request->name,
            'description' => $request->description,
            'business_id' => $request->business_id,
            'employer_id' => $request->employer_id,
            'price' => 0,
            'address' => $request->address,
        ]);
        $service->save();

        $start_day = Carbon::parse($request->start_day);
        $start_middle_reset = Carbon::parse($request->start_middle_rest);
        $end_middle_rest = Carbon::parse($request->end_middle_rest);
        $end_day = Carbon::parse($request->end_day);
        $timetable = new Timetable([
            'service_id' => $service->getAttributes()["id"],
            'start_day' => $start_day,
            'start_middle_rest' => $start_middle_reset,
            'end_middle_rest' => $end_middle_rest,
            'end_day' => $end_day,
            'time_length' => $request->time_length,
            'gap_length' => $request->gap_length
        ]);
        $timetable->save();
        return response()->json([
            'message' => 'Service created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
