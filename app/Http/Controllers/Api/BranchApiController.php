<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use App\Models\Category;
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
        $categories = Category::select('id','name')->get();
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
            $branches = Branch::selectRaw("*,( 6371 * acos( cos( radians(?) ) *
                                        cos( radians( lat ) )
                                        * cos( radians( lng ) - radians(?)
                                        ) + sin( radians(?) ) *
                                        sin( radians( lat ) ) )
                                        ) AS distance", [request()->lat, request()->lng, request()->lat])
                                        ->having("distance", "<", $radius);

            if ($category != 'all') {

                $branches = $branches->whereHas('restaurant', function($query) use($category) {
                    $query->whereHas('categories', function($query) use($category){
                        $query->where('categories.name', $category);
                    });
                 }); //// not finished
            }

            $branches = $branches->orderBy("distance",'asc')
                                    ->with('restaurant.categories','city.governorate')
                                    ->paginate(20);
            
            
        }else{
            if($category != 'all')
            {
                $branches = Branch::whereHas('restaurant', function($query) use($category) {
                    $query->whereHas('categories', function($query) use($category){
                        $query->where('categories.name', $category);
                    });
                 })->inRandomOrder()->with('restaurant.categories','city.governorate')->paginate(20);
            }else{
                $branches = Branch::inRandomOrder()->with('restaurant.categories','city.governorate')->paginate(20);
            }
        }
        // return $branches;
        if ($branches->count() < 1) {
            $response = [
                'message'   => 'There is no Available Results',
                'validation'=> [],    
                'data'      => [],
                'code'      => 200
            ];
        }else{
            $response = [
                'message'   => '',
                'validation'=> [],    
                'data'      => ['categories' => $categories,'branches' => $branches],
                'code'      => 200
            ];
        }


        return response()->json($response, 200);
    }
}
