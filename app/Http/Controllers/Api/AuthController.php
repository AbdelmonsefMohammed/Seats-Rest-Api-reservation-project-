<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register endpoint
     *
     * This endpoint allows you to register new user.
     * It's a really useful endpoint, and you should play around 
     * with it for a bit.
     * <aside class="notice">We mean it; you really should.😕</aside>
     */
    public function register(Request $request)
    {
        $this->validate($request, User::rules());

        $user = User::create($request->all());
        $user->assignRole('customer');
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
            'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }
}