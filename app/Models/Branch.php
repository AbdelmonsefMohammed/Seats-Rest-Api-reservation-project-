<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $appends = ['rating'];
    protected $guarded = ['id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function savedPlaces()
    {
        return $this->hasMany(SavedPlaces::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function branchRatings()
    {
        return $this->hasMany(BranchRating::class);
    }

    // public function avgRating()
    // {
    //     return $this->branchRatings()
    //                 ->selectRaw('avg(rating) as result, branch_id')
    //                 ->groupBy('branch_id');
    // }

    // public function getAvgRatingAttribute()
    // {
    //     if ( ! array_key_exists('avgRating', $this->relations)) {
    //     $this->load('avgRating');
    //     }

    //     $relation = $this->getRelation('avgRating')->first();

    //     return ($relation) ? $relation->aggregate : null;
    // }

    // public function tempRating($rating)
    // {
    //     if (CEIL($this->branchRatings()->avg('rating')) == $rating) {
    //         return CEIL($this->branchRatings()->avg('rating'));
    //     }
    //     // return CEIL($this->branchRatings()->avg('rating'))?: 0;
    // }

    public function getRatingAttribute()
    {
            return CEIL($this->branchRatings()->avg('rating'))?: 0;
    }

    public static function rules($update = false, $id = null)
    {
        $common = [
            'lat'           => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng'           => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'address'       => "required",
            'landline'      => "nullable",
            'mobile1'       => "nullable",
            'mobile2'       => "nullable",
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            
        ]);
    }
}
