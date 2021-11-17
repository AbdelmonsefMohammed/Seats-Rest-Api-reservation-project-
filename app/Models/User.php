<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'number', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function savedPlaces()
    { 
        return $this->hasMany(SavedPlaces::class);
    }

    public static function rules($update = false, $id = null)
    {
        $common = [
            'name'      => 'required|string|max:255',
            'email'     => "required|string|email|max:255|unique:users,email,$id",
            'password'  => 'nullable|confirmed|string|min:8',
            'avatar'    => 'nullable|image|mimes:jpeg,jpg,png|max:10000'
        ];

        if ($update) {
            return $common;
        }

        return array_merge($common, [
            'email'     => "required|string|email|max:255|unique:users",
            'password'  => 'required|confirmed|string|min:8',
        ]);
    }
}
