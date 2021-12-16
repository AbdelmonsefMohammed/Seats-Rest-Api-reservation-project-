<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseApiController
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
            'number'    => 'required',
        ]);

        if ($validator->fails()) {

            return $this->return_fail('The given data was invalid', $validator->errors());
        }
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'number'    => $request->number,
        ]);
        $user->assignRole('customer');
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = ['user'         => $user,
                'access_token'  => $token,
                'token_type'    => 'Bearer',
                ];

        return $this->return_success( 'User registered successfully', $data);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string|min:8'
        ]);

        if ($validator->fails()) {

            return $this->return_fail('The given data was invalid', $validator->errors());

        }

        if (!Auth::attempt($request->only('email', 'password'))) {

            return $this->return_fail('Invalid login details', ["email" => [ "Invalid email or password." ]]);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $data = ['user'          => $user,
                 'access_token'  => $token,
                 'token_type'    => 'Bearer',
                ];
        return $this->return_success( 'User looged in successfully', $data);

    }
    public function sendPasswordResetLinkEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {

            return $this->return_fail('The given data was invalid', $validator->errors());

        }

		$status = Password::sendResetLink(
			$request->only('email')
		);

		if($status === Password::RESET_LINK_SENT) {

            return $this->return_success( 'We have emailed your password reset link!', []);

		} else {

            return $this->return_fail('The given data was invalid', ['email' => __($status)]);

		}
	}

	public function resetPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'token'     => 'required',
            'email'     => 'required|string|email|max:255',
            'password'  => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {

            return $this->return_fail('The given data was invalid', $validator->errors());

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

            return $this->return_success(__($status), []);

		} else {

            return $this->return_fail('The given data was invalid', ['email' => __($status)]);

        }
	}

    public function logout()
    {
        // logout from all devices
        // auth()->user()->tokens()->delete();

        // logout from current device only
        auth()->user()->currentAccessToken()->delete();

        return $this->return_success('User Logged out successfully', []);
    }
}
