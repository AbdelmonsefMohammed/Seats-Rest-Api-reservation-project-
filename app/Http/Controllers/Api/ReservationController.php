<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::whereHas('branch')
                                    ->where('user_id', auth()->user()->id)
                                    ->with('branch.restaurant.categories','branch.city.governorate')
                                    ->get();
        $response = [
            'message'   => 'User Reservations',
            'validation'=> [],    
            'data'      => ['reservations'  => $reservations],
            'code'      => 200
        ];

        return response()->json($response, 200);
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
        $validator = Validator::make($request->all(), [
            'branch_id'         => 'required|exists:branches,id',
            'date'              => "required|after:yesterday|date_format:Y-m-d",
            'time'              => 'required|date_format:H:i',
            'number_of_seats'   => 'required|integer'
        ]);

        if ($validator->fails()) {
            $response = [
                'message'   => 'The given data was invalid',
                'validation'=> $validator->errors(),    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
        }
        
            
        $reservation = Reservation::create([
            'user_id'           => auth()->user()->id,
            'branch_id'         => $request->branch_id,
            'date'              => $request->date,
            'time'              => $request->time,
            'number_of_seats'   => $request->number_of_seats,
        ]);
        $reservation->load('branch.restaurant');
        $response = [
            'message'   => 'User created reservation successfully',
            'validation'=> [],    
            'data'      => ['reservation'  => $reservation,],
            'code'      => 200
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
