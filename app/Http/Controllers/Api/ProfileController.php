<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function updateProfileData(Request $request)
    {
        $user_id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'number'    => 'required|string|max:255',
            'email'     => "required|string|email|max:255|unique:users,email,$user_id",
            'password'  => 'nullable|confirmed|string|min:8',
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

        auth()->user()->update($request->all());

        $response = [
            'message'   => 'User updated profile successfully',
            'validation'=> [],    
            'data'      => ['user'  => auth()->user()],
            'code'      => 200,

        ];

        return response()->json($response, 200);
    }

    public function updateAvatar()
    {
        if (request()->hasFile('avatar')) {
            $avatar = auth()->user()->avatar;
            $user_id = auth()->user()->id;
            if(!empty($avatar))
            {
                $picture = "/storage/users/{$user_id}/{$avatar}";
                $path = str_replace('\\','/',public_path());
                
                if(file_exists($path . $picture))
                {
                    unlink($path . $picture);
                }
            }
            $pic = time() . '_' . request()->file('avatar')->getClientOriginalName();
            request()->file('avatar')->storeAs('/',"/users/{$user_id}/{$pic}", '');

            auth()->user()->update(['avatar' => $pic]);
        }else{
            $response = [
                'message'   => 'invalid request',
                'validation'=> [ "avatar" => [ "No Image Was attached."]],    
                'data'      => [],
                'code'      => 400,
    
            ];
    
            return response()->json($response, 400);
        }
    }

    public function deleteAvatar()
    {
        $avatar = auth()->user()->avatar;
        $user_id = auth()->user()->id;
        if(!empty($avatar))
        {
            $picture = "/storage/users/{$user_id}/{$avatar}";
            $path = str_replace('\\','/',public_path());
            
            if(file_exists($path . $picture))
            {
                unlink($path . $picture);
            }
        }

        auth()->user()->update(['avatar' => NULL]);
        
        $response = [
            'message'   => 'Avatar deleted successfully',
            'validation'=> [],    
            'data'      => ['user'  => auth()->user()],
            'code'      => 200,

        ];

        return response()->json($response, 200);
    }
}
