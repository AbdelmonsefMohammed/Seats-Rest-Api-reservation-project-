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

            // $validation = $validator->errors();

            return $this->return_fail('The given data was invalid', $validator->errors());
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
        
    }
}
