<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public static function rules($update = false, $id = null)
    {
        $common = [
            'name'          => "required|unique:categories,name,$id",
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'name'          => "required|unique:categories",
        ]);
    }
}
