<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseApiController
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

            return $this->return_fail('The given data was invalid', $validator->errors());

        }
        if ($request->password) {
            $request->merge([
                'password' => Hash::make($request->password),
            ]);
        }

        auth()->user()->update($request->all());

        $data = ['user'  => auth()->user()];

        return $this->return_success('User updated profile successfully', $data);

    }

    public function updateAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar'    => 'required|image|mimes:jpeg,jpg,png|max:10000'
        ]);

        if ($validator->fails()) {
            
            return $this->return_fail('The given data was invalid', $validator->errors());
        }

        if ($request->file('avatar')) {
            $avatar = auth()->user()->avatar;
            $user_id = auth()->user()->id;
            if(!empty($avatar))
            {
                self::deleteFile($user_id, $avatar);
            }
            $pic = time() . '_' . request()->file('avatar')->getClientOriginalName();
            request()->file('avatar')->storeAs('/',"/users/{$user_id}/{$pic}", '');

            auth()->user()->update(['avatar' => $pic]); 

            return $this->return_success('User updated avatar successfully', []);
  
        }

    }

    public function deleteAvatar()
    {
        $avatar = auth()->user()->avatar;
        $user_id = auth()->user()->id;
        if(!empty($avatar))
        {
            self::deleteFile($user_id, $avatar);

        }

        auth()->user()->update(['avatar' => NULL]);

        $data = ['user'  => auth()->user()];

        return $this->return_success('Avatar deleted successfully', $data);
        
    }

    static function deleteFile($user_id, $avatar)
    {
        $picture = "/storage/users/{$user_id}/{$avatar}";
        $path = str_replace('\\','/',public_path());
        
        if(file_exists($path . $picture))
        {
            unlink($path . $picture);
        }
        return True;
    }
}
