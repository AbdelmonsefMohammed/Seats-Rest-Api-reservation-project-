<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['price_range_symbol','picture_path','logo_path','store_status'];
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

    public function getPicturePathAttribute()
    {
            return $this->picture? "/storage/restaurants/" : NULL;
    }

    public function getLogoPathAttribute()
    {
            return $this->logo? "/storage/restaurants/logos/" : NULL;
    }

    public function getStoreStatusAttribute()
    {
        $now = new DateTime();
        $opening_time = new DateTime($this->opening_time);
        $closing_time = new DateTime($this->closing_time);

        return $now >= $opening_time && $now <= $closing_time ? TRUE : FALSE;
        
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
