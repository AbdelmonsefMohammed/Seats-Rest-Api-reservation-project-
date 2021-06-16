<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['price_range_symbol'];
    public function getPriceRangeSymbolAttribute()
    {
        switch($this->attributes['price_range']){
            case 1:
                return "$";
            case 2:
                return "$$";
            default:
                return "$$$";
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public static function rules($update = false, $id = null)
    {
        $common = [
            'name'          => "required|unique:restaurants,name,$id",
            'main_number'   => "nullable",
            'website_link'  => "nullable",
            'picture'       => "nullable|mimes:jpeg,jpg,png",
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'name'          => "required|unique:categories",
        ]);
    }
}
