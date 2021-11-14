<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = ['id'];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'id', 'branch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function rating()
    // {
    //     return $this->hasMany(BranchRating::class);
    // }
    
    // public function userRating()
    // {
    //     return $this->rating->latest();
    // }

    // public function avgRating()
    // {
    // return $this->rating->avg('rating');
    // }
    
}
