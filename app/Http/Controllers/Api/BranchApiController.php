<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchApiController extends Controller
{
    /**
     * @header Get Branches in home screen endpoint
     * 
     * required the category of the restaurants by default use (all) to get all types of restaurants
     * or you can use the id of the category you want to show.
     * @urlParam category Example: all
     * 
     * @queryParam lat you send the lat of the user (User need to enable GPS). No-example
     * @queryParam lng you send the lng of the user (User need to enable GPS). No-example
     * @queryParam distance you send the max distance you want to search for By (km) the logged in user By dafault
     * the distance is 20 km (can only be used if lat and lng are provided) . Example: 20
     * 
     * 
     */
    public function getBranchesByCategory($category = 'all')
    {
        if (request()->lat && request()->lng) {
            if (request()->distance) {
                $radius = request()->distance;
            }else{
                $radius = 20;
            }
            /*
            * using eloquent approach, make sure to replace the "Restaurant" with your actual model name
            * replace 6371000 with 6371 for kilometer and 3956 for miles
            */
            $branches = Branch::selectRaw("id, restaurant_id, lat, lng, address, city_id, landline, mobile1, mobile2,
                                        ( 6371 * acos( cos( radians(?) ) *
                                        cos( radians( lat ) )
                                        * cos( radians( lng ) - radians(?)
                                        ) + sin( radians(?) ) *
                                        sin( radians( lat ) ) )
                                        ) AS distance", [request()->lat, request()->lng, request()->lat])
                                        ->having("distance", "<", $radius);

            if ($category != 'all') {

                $branches = $branches->whereHas('restaurant', function($query) use($category) {
                    $query->whereHas('categories', function($query) use($category){
                        $query->where('categories.id', $category);
                    });
                 }); //// not finished
            }

            $branches = $branches->orderBy("distance",'asc')
                                    ->offset(0)
                                    ->limit(20)
                                    ->with('restaurant','city.governorate')
                                    ->get();
            
            
        }else{
            if($category != 'all')
            {
                $branches = Branch::whereHas('restaurant', function($query) use($category) {
                    $query->whereHas('categories', function($query) use($category){
                        $query->where('categories.id', $category);
                    });
                 })->inRandomOrder()->limit(20)->with('restaurant','city.governorate')->get();
            }else{
                $branches = Branch::inRandomOrder()->limit(20)->with('restaurant','city.governorate')->get();
            }
        }
        // return $branches;
        return response()->json(['branches' => $branches]);
    }
}
