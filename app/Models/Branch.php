<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
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
