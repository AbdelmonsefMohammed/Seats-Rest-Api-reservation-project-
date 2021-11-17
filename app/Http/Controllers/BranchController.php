<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Branch;
use App\Models\Restaurant;
use App\Models\Governorate;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $branches = Branch::all();
        $branches = Branch::with('city.governorate','restaurant','branchRatings')->get();
        return view('Dashboard.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        $governorates = Governorate::all();
        return view('Dashboard.branches.create',compact('restaurants','governorates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Branch::rules());

        Branch::create($request->all());

        return redirect()->route('dashboard.branches.index')->with('success','Item added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $restaurants = Restaurant::all();
        $governorates = Governorate::all();
        $cities = City::where('governorate_id', $branch->city->governorate_id)->get();
        return view('Dashboard.branches.edit', compact('branch','restaurants','governorates','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $this->validate($request, Branch::rules($update = true, $branch->id));

        $branch->update($request->all());

        return redirect()->route('dashboard.branches.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        try{
            $branch->delete();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors('Can\'t delete this item.');
        }

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    public function getcities($id)
    {
        $cities = City::where('governorate_id',$id)->get()->pluck('city_name_en','id');
        return json_encode($cities);
    }
}