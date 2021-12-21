<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();

        return view('Dashboard.reservations.index', compact('reservations'));
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
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('Dashboard.reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        if ($request->status == 'Approved') {
            
            $restaurant_expiration_time = $reservation->branch->restaurant->expiration_time;
            $datetime = date('Y-m-d H:i:s', strtotime("$reservation->date $reservation->time"));
            $reservation_time = Carbon::parse($datetime);
            $code_expiration_date = $reservation_time->addMinutes($restaurant_expiration_time);


            $reservation->update(['code' => self::generateCode() , 'code_expiration_date' => $code_expiration_date]);
        }
        $reservation->update(['status' => $request->status]);

        return redirect()->route('dashboard.reservations.index')->with('success', "Reservation {$request->status}.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        try{
            $reservation->delete();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors('Can\'t delete this item.');
        }

        return redirect()->back()->with('success', 'Reservation deleted successfully.');
    }

    public static function generateCode($length = 10) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
