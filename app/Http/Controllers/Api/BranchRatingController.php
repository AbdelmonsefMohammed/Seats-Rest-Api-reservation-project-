<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use App\Models\BranchRating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BranchRatingController extends Controller
{
    public function rateBranch($branch_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating'    => ['required',Rule::in(['1','2','3','4','5'])],
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

        // user can't rate branch he didn't have reservation type status = Completed
        $check_existing_reservation = Reservation::where('user_id', auth()->user()->id)->where('branch_id', $branch_id)->where('status', 'Completed')->count();
        if(!$check_existing_reservation > 0){
            $response = [
                'message'   => 'Failed user can\'t rate restaurants he hasn\'t booked in before',
                'validation'=> [],    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
        }

        $rating = BranchRating::create([
            'user_id'   => auth()->user()->id,
            'branch_id' => $branch_id,
            'rating'    => $request->rating,
            'comment'   => $request->comment
        ]);
        
        $response = [
            'message'   => 'User rated the application',
            'validation'=> [],
            'data'      => ['rating'  => $rating],
            'code'      => 200
        ];


        return response()->json($response, 200);
    }
}