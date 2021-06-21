<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchApiController extends Controller
{

    public function getBranchesFromLocation($category)
    {
        if (request()->lat && request()->lng) {
            if (request()->distance) {
                $radius = request()->distance;
            }else{
                $radius = 50;
            }
            /*
            * using eloquent approach, make sure to replace the "Restaurant" with your actual model name
            * replace 6371000 with 6371 for kilometer and 3956 for miles
            */
            $restaurants = Branch::selectRaw("id, restaurant_id, lat, lng, address, city_id, landline, mobile1, mobile2,
            ( 6371 * acos( cos( radians(?) ) *
            cos( radians( lat ) )
            * cos( radians( lng ) - radians(?)
            ) + sin( radians(?) ) *
            sin( radians( lat ) ) )
            ) AS distance", [request()->lat, request()->lng, request()->lat])
            ->having("distance", "<", $radius);

            if ($category != 'all') {
                $restaurants = $restaurants->whereHas(''); //// not finished
            }

            $restaurants = $restaurants->orderBy("distance",'asc')
                                    ->offset(0)
                                    ->limit(20)
                                    ->with('restaurant','city.governorate')
                                    ->get();
            // return $restaurants;
            return response()->json(['restaurants' => $restaurants]);
        }
    }
}
