<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('Dashboard.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Restaurant::rules());

        $pic = time() . '_' . request()->file('picture')->getClientOriginalName();
        request()->file('picture')->storeAs('/',"/restaurants/{$pic}", '');

        Restaurant::create(array_merge($request->all(), ['picture' => $pic]));

        return redirect()->route('dashboard.restaurants.index')->with('success','Item added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('Dashboard.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $this->validate($request, Restaurant::rules($update = true, $restaurant->id));

        if (request()->hasFile('picture')) {
            if(!empty($restaurant->picture))
            {
                $picture = "/storage/restaurants/{$restaurant->picture}";
                $path = str_replace('\\','/',public_path());
                
                if(file_exists($path . $picture))
                {
                    unlink($path . $picture);
                }
            }
            $pic = time() . '_' . request()->file('picture')->getClientOriginalName();
            request()->file('picture')->storeAs('/',"/restaurants/{$pic}", '');

            $request->request->add(['picture' => $pic]);
        }

        $restaurant->update($request->all());

        return redirect()->route('dashboard.restaurants.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        try{
            $restaurant->delete();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors('Can\'t delete this item.');
        }

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}