<?php

namespace App\Http\Controllers\Api;

use App\Models\AppRating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AppRatingController extends BaseApiController
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

        $rating = AppRating::updateOrCreate(
            [
                'user_id'    => auth()->user()->id,
            ],
            [
                'rating'    => $request->rating,
                'reason'    => $request->reason,
                'comment'   => $request->comment,
            ]
        );
        
        $data = ['rating'  => $rating];

        return $this->return_success('User rated the application', $data);
        
        // if (AppRating::where('user_id', auth()->user()->id)->exists()) {

        //     $rating = tap(AppRating::where('user_id', auth()->user()->id))->update($request->all())->first();
        //     $response = [
        //         'message'   => 'User updated application rating',
        //         'validation'=> [],    
        //         'data'      => ['rating'  => $rating,],
        //         'code'      => 200
        //     ];

        // }else{
            
        //     $rating = AppRating::create(array_merge($request->all(), ['user_id' => auth()->user()->id]));
        //     $response = [
        //         'message'   => 'User rated the application',
        //         'validation'=> [],    
        //         'data'      => ['rating'  => $rating,],
        //         'code'      => 200
        //     ];
        // }

        return response()->json($response, 200);
    }
}
