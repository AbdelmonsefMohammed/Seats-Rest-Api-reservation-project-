<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\SavedPlaces;
use Illuminate\Http\Request;

class SavedPlacesController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::whereHas('savedPlaces', function($query){
            $query->where('user_id', auth()->user()->id);
        })->with('restaurant.categories','city.governorate')->get();

        $data = ['SavedPlaces'  => $branches];

        return $this->return_success('User Saved places', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($branch_id)
    {
        $check_if_exists = SavedPlaces::where('user_id', auth()->user()->id)->where('branch_id', $branch_id)->get();
        if($check_if_exists->count() > 0)
        {
            
            return $this->return_fail('Restaurant already exists in Saved Places', []);

        }
        SavedPlaces::create(['user_id' => auth()->user()->id, 'branch_id' => $branch_id]);

        return $this->return_success('Restaurant added to Saved Places', []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($branch_id)
    {
        $check_if_exists = SavedPlaces::where('user_id', auth()->user()->id)->where('branch_id', $branch_id)->get();
        if($check_if_exists->count() > 0)
        {
            SavedPlaces::where('user_id', auth()->user()->id)->where('branch_id', $branch_id)->delete();

            return $this->return_success('Restaurant deleted from Saved Places Successfully', []);
        }

        return $this->return_fail('Restaurant does not exist in Saved Places', []);

    }
}
