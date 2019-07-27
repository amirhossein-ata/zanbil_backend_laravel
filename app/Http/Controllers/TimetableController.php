<?php

namespace App\Http\Controllers;

use App\Timetable;
use Illuminate\Http\Request;
use App\Http\Resources\Timetable as TimetableResource;
use App\Service;
use App\Http\Resources\TimetableCollection;
use Carbon\Carbon;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TimetableCollection(Timetable::all());
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
            'service_id' => 'required|integer',
            'start_day' => 'required|string',
            'start_middle_rest' => 'required|string',
            'end_middle_rest' => 'required|string',
            'end_day' => 'required|string',
            'time_length' => 'required|integer',
            'gap_length' => 'required|integer'
        ]);
        $service =  Service::find($request->service_id);
        // dd($service);
        if($service === null){
            return response()->json([
                'message' => 'service not found'
            ], 400);
        }
        if($service->timetable !== null){
            return response()->json([
                'message' => 'this service already has a timetable'
            ], 400);
        }

        $start_day = Carbon::parse($request->start_day);
        $start_middle_reset = Carbon::parse($request->start_middle_rest);
        $end_middle_rest = Carbon::parse($request->end_middle_rest);
        $end_day = Carbon::parse($request->end_day);
        $timetable = new Timetable([
            'service_id' => $request->service_id,
            'start_day' => $start_day,
            'start_middle_rest' => $start_middle_reset,
            'end_middle_rest' => $end_middle_rest,
            'end_day' => $end_day,
            'time_length' => $request->time_length,
            'gap_length' => $request->gap_length
        ]);
        $timetable->save();
        return response()->json([
            'message' => 'Timetable created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        return new TimetableResource($timetable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $timetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //
    }
}
