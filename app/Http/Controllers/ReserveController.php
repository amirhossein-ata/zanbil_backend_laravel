<?php

namespace App\Http\Controllers;

use App\Reserve;
use App\Service;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\ReserveCollection;
use App\Http\Resources\Reserve as ReserveResource;


class ReserveController extends Controller
{

    public function isServiceTimeFull($start_time, $end_time, $reserve_date, $service_id){
        $reserves = Reserve::where('service_id', $service_id)->get();
        // dd($reserves);
        $duplicate_reserve = $reserves->search(function ($value) use($start_time, $end_time, $reserve_date) {
            return  Carbon::parse($value->start_time)->equalTo($start_time) &&
                    Carbon::parse($value->end_time)->equalTo($end_time) &&
                    Carbon::parse($value->reserve_date)->equalTo($reserve_date) ;
        });
        if($duplicate_reserve !== false){
            return true;
        }
        return false;
    }

    public function isCustomerTimeFull($start_time, $end_time, $reserve_date, $customer_id){
        $reserves = Reserve::where('customer_id', $customer_id)->get();
        $duplicate_reserve = $reserves->search(function ($value) use($start_time, $end_time, $reserve_date) {
            return  Carbon::parse($value->start_time)->equalTo($start_time) &&
                    Carbon::parse($value->end_time)->equalTo($end_time) &&
                    Carbon::parse($value->reserve_date)->equalTo($reserve_date) ;
        });
        if($duplicate_reserve !== false){
            return true;
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ReserveCollection(Reserve::all());
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
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'reserve_date' => 'required|string'
        ]);
        

        $customer = $request->user()->customer;
        if($customer === null) {
            $customer = new Customer([
                'user_id' => $request->user()->id,
            ]);
            $customer->save();
        }
        
        $service = Service::find($request->service_id);
       
        if($service === null) {
            return response()->json([
                'message' => 'service not found'
            ], 400);
        }
     
        $start_time = Carbon::parse($request->start_time);
        $end_time = Carbon::parse($request->end_time);
        $reserve_date = Carbon::parse($request->reserve_date);
        // check if start time is not greater that end_time
        if($start_time > $end_time) {
            return response()->json([
                'message' => 'start time can not be greater that end time'
            ]);
        }

        // check if service does'nt have any other reservation in that time
        if(self::isServiceTimeFull($start_time, $end_time, $reserve_date, $request->service_id)){
            return response()->json([
                'message' => 'that time is full for service'
            ], 400);
        }
       
        // check if customer does'nt have any other reservation in that time
        if(self::isCustomerTimeFull($start_time, $end_time, $reserve_date, $customer->id)){
            return response()->json([
                'message' => 'that time is full for customer'
            ], 400);
        }
       
        $reserve = new Reserve([
            'service_id' => $request->service_id,
            'customer_id' => $customer->id,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'reserve_date' => $reserve_date,
        ]);
        $reserve->save();
        return response()->json([
            'message' => 'Reserve created successfully'
        ], 200);
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        return new ReserveResource($reserve);   
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        //
    }
}
