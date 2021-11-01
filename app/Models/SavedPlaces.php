<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedPlaces extends Model
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
}
