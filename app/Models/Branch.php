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

    public static function rules($update = false, $id = null)
    {
        $common = [
            'lat'           => "required",
            'lng'           => "required",
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
