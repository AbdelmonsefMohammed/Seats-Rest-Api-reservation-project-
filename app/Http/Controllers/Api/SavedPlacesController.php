<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\SavedPlaces;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SavedPlacesController extends Controller
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

        $response = [
            'message'   => 'User Saved places',
            'validation'=> [],    
            'data'      => ['SavedPlaces'  => $branches],
            'code'      => 200
        ];

        return response()->json($response, 200);
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
            $response = [
                'message'   => 'Restaurant already exists in Saved Places',
                'validation'=> [],    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
        }
        SavedPlaces::create(['user_id' => auth()->user()->id, 'branch_id' => $branch_id]);

        $response = [
            'message'   => 'Restaurant added to Saved Places',
            'validation'=> [],    
            'data'      => [],
            'code'      => 200
        ];

        return response()->json($response, 200);
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
            $response = [
                'message'   => 'Restaurant deleted from Saved Places Successfully',
                'validation'=> [],    
                'data'      => [],
                'code'      => 200
            ];
    
            return response()->json($response, 200);
        }

        $response = [
            'message'   => 'Restaurant does not exist in Saved Places',
            'validation'=> [],    
            'data'      => [],
            'code'      => 400
        ];

        return response()->json($response, 400);
    }
}
