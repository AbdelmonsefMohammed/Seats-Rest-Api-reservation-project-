<?php

namespace App\Http\Controllers\Api;

use App\Models\AppRating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AppRatingController extends Controller
{
    public function rateapp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating'    => ['required',Rule::in(['Love it','Meh!','bad'])],
            'reason'    => "nullable|string",
            'comment'   => 'nullable',
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
        
        if (AppRating::where('user_id', auth()->user()->id)->exists()) {

            $rating = tap(AppRating::where('user_id', auth()->user()->id))->update($request->all())->first();
            $response = [
                'message'   => 'User updated application rating',
                'validation'=> [],    
                'data'      => ['rating'  => $rating,],
                'code'      => 200
            ];

        }else{
            
            $rating = AppRating::create(array_merge($request->all(), ['user_id' => auth()->user()->id]));
            $response = [
                'message'   => 'User rated the application',
                'validation'=> [],    
                'data'      => ['rating'  => $rating,],
                'code'      => 200
            ];
        }

        return response()->json($response, 200);
    }
}
