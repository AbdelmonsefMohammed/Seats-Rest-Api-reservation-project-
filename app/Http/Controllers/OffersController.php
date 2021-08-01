<?php

namespace App\Http\Controllers;

use App\Models\Offers;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('Dashboard.offers.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Dashboard.offers.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Offers::rules());
        $categories_array = [];
        $categories = $request->except('_token','name','main_number','opening_time','closing_time','website_link','type','price_range','picture');
        foreach ($categories as $key => $value) {
            $arr = explode('_',$key);
            $categories_array[] = $arr[1];
        }
        $pic = time() . '_' . request()->file('picture')->getClientOriginalName();
        request()->file('picture')->storeAs('/',"/offers/{$pic}", '');
        $offer = Offers::create(array_merge($request->all(), ['picture' => $pic]));
        $offer->categories()->attach($categories_array);

        return redirect()->route('dashboard.offers.index')->with('success','Item added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function show(Offers $offers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function edit(Offers $offers)
    {
        $categories = Category::all();
        $offerCategories = $offer->categories->pluck('id')->toArray();
        return view('Dashboard.offers.edit', compact('Offers','categories','OffersCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offers $offers)
    {
        $categories_array = [];
        $categories = $request->except('_token','_method','name','main_number','opening_time','closing_time','website_link','type','price_range','picture');
        foreach ($categories as $key => $value) {
            $arr = explode('_',$key);
            $categories_array[] = $arr[1];
        }
        $this->validate($request, Offers::rules($update = true, $offer->id));

        if (request()->hasFile('picture')) {
            if(!empty($offer->picture))
            {
                $picture = "/storage/offers/{$offer->picture}";
                $path = str_replace('\\','/',public_path());
                
                if(file_exists($path . $picture))
                {
                    unlink($path . $picture);
                }
            }
            $pic = time() . '_' . request()->file('picture')->getClientOriginalName();
            request()->file('picture')->storeAs('/',"/offers/{$pic}", '');

            $request->request->add(['picture' => $pic]);
        }

        $offer->update($request->all());
        $offer->categories()->detach();
        $offer->categories()->attach($categories_array);
        return redirect()->route('dashboard.offers.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offers $offers)
    {
        try{
            $offer->delete();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors('Can\'t delete this item.');
        }

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
