<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = ['id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rating()
    {
        return $this->hasMany(RestaurantRating::class);
    }

    public function avgRating()
{
    return $this->rating->avg('rating');
}
}
