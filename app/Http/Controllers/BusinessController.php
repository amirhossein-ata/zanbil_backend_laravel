<?php

namespace App\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use App\Http\Resources\Business as BusinessResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Input;
use App\Http\Resources\BusinessCollection;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return new BusinessCollection(Business::all());
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
            'address' => 'required|string',
            'manager_id' => 'required|integer',
        ]);
        $business = new Business([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'manager_id' => $request->manager_id,
            'price' => 0
        ]);
        $business->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        return new BusinessResource($business);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {   
        if($request->name !== null){
            $business->name = $request->name;
        }
        if($request->description !== null){
            $business->description = $request->description;
        }
        if($request->price !== null){
            $business->price = $request->price;
        }
        if($request->address !== null){
            $business->address = $request->address;
        }
        $business->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        $business->forceDelete();
    }
}
