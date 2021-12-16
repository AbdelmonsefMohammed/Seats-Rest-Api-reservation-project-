<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use App\Models\BranchRating;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BranchRatingController extends BaseApiController
{
    public function rateBranch($branch_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating'    => ['required',Rule::in(['1','2','3','4','5'])],
            'comment'   => 'nullable',
        ]);


        if ($validator->fails()) {

            return $this->return_fail('The given data was invalid', $validator->errors());

        }

        // user can't rate branch he didn't have reservation type status = Completed
        $check_existing_reservation = Reservation::where('user_id', auth()->user()->id)->where('branch_id', $branch_id)->where('status', 'Completed')->count();
        if(!$check_existing_reservation > 0){

            return $this->return_fail('Failed user can\'t rate restaurants he hasn\'t booked in before', []);

        }

        $rating = BranchRating::create([
            'user_id'   => auth()->user()->id,
            'branch_id' => $branch_id,
            'rating'    => $request->rating,
            'comment'   => $request->comment
        ]);

        $data = ['rating'  => $rating];

        return $this->return_success('User rated the restautant', $data);
    }
}