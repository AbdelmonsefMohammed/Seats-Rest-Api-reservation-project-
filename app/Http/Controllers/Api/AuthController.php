<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => "required|string|email|max:255|unique:users",
            'password'  => 'required|confirmed|string|min:8',
            'avatar'    => 'nullable|image|mimes:jpeg,jpg,png|max:10000'
        ]);

        if ($validator->fails()) {
            $response = [
                'message'   => 'The given data was invalid',
                'validation'=> $validator->errors(),    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('customer');
        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'message'   => 'User registered successfully',
            'validation'=> [],    
            'data'  => ['user'          => $user,
                        'access_token'  => $token,
                        'token_type'    => 'Bearer',
                        ],
            'code'      => 200,

        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            $response = [
                'message'   => 'The given data was invalid',
                'validation'=> $validator->errors(),    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            $response = [
                'message'   => 'Invalid login details',
                'validation'=> [  "email" => [ "Invalid email or password." ]],    
                'data'      => [],
                'code'      => 400
            ];
            return response()->json($response, 400);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'message'   => 'User looged in successfully',
            'validation'=> [],    
            'data'  => ['user'          => $user,
                        'access_token'  => $token,
                        'token_type'    => 'Bearer',
                        ],
            'code'      => 200,
        ];

        return response()->json($response, 200);
    }
    public function sendPasswordResetLinkEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            $response = [
                'message'   => 'The given data was invalid',
                'validation'=> $validator->errors(),    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
        }

		$status = Password::sendResetLink(
			$request->only('email')
		);

		if($status === Password::RESET_LINK_SENT) {
            $response = [
                'message'   => 'We have emailed your password reset link!',
                'validation'=> [],    
                'data'      => [],
                'code'      => 200
            ];
    
            return response()->json($response, 200);
		} else {
            $response = [
                'message'   => 'The given data was invalid',
                'validation'=> ['email' => __($status)],    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
		}
	}

	public function resetPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            $response = [
                'message'   => 'The given data was invalid',
                'validation'=> $validator->errors(),    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
        }

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) use ($request) {
				$user->forceFill([
					'password' => Hash::make($password)
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		if($status == Password::PASSWORD_RESET) {
            $response = [
                'message'   => __($status),
                'validation'=> [],    
                'data'      => [],
                'code'      => 200
            ];
    
            return response()->json($response, 200);

		} else {
            $response = [
                'message'   => 'The given data was invalid',
                'validation'=> ['email' => __($status)],    
                'data'      => [],
                'code'      => 400
            ];
    
            return response()->json($response, 400);
		}
	}

    public function logout()
    {
        // logout from all devices
        // auth()->user()->tokens()->delete();

        // logout from current device only
        auth()->user()->currentAccessToken()->delete();
        $response = [
            'message'   => 'User Logged out successfully',
            'validation'=> [],    
            'data'      => [],
            'code'      => 200
        ];

        return response()->json($response, 200);

    }
}
