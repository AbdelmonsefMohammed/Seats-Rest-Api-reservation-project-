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
use Illuminate\Validation\ValidationException;

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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('customer');
        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'code' => 201,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data'  => $user
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string|min:8'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'code'    => 401,
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $fields['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'code'          => 200,
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            'data'          => $user
        ];

        return response()->json($response, 200);
    }
    public function sendPasswordResetLinkEmail(Request $request) {
		$request->validate(['email' => 'required|email']);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		if($status === Password::RESET_LINK_SENT) {
			return response()->json(['message' => __($status)], 200);
		} else {
			throw ValidationException::withMessages([
				'email' => __($status)
			]);
		}
	}

	public function resetPassword(Request $request) {
		$request->validate([
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8|confirmed',
		]);

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
			return response()->json(['message' => __($status)], 200);
		} else {
			throw ValidationException::withMessages([
				'email' => __($status)
			]);
		}
	}

    public function logout()
    {
        // logout from all devices
        // auth()->user()->tokens()->delete();

        // logout from current device only
        auth()->user()->currentAccessToken()->delete();
        return [
            'code' => 200,
            'message'   => 'User Logged out'
        ];
    }
}
