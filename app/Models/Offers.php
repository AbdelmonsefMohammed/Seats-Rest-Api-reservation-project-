<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $guarded = ['id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
