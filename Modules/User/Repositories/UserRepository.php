<?php

namespace Modules\User\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\User\Entities\User;
use Laravel\Sanctum\PersonalAccessToken;


class UserRepository extends EloquentBaseRepository
{
    /**
     * Create User (Register)
     * @return User
     */
    public function register($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'location' => $data['location'],
            'location_details' => $data['location_details'],
        ]);

        if ($data->hasFile('user_picture') && $data->file('user_picture')->isValid()) {
            $userPicture = $data->file('user_picture');
            $extension = $userPicture->getClientOriginalExtension();
            $pictureName = uniqid('userPic') . '.' . $extension;
            $userPicture->storeAs('public/pictures', $pictureName);
            $user->user_picture = $pictureName;
            $user->save();
        }

        return $user;
    }
  

    /**
    * Login
    * @return User
    */
    public  function login($request)
    {
        $user = User::where('email', $request['email'])->first();
        return $user;
    }

    /**
    * Logout
    * @return User
    */
    public  function logout()
    {
        $logout = Auth::logout();
        return $logout;
    }

    /**
    * Update User
    * @return User
    */
    public  function updateUser($data,$userId)
    {
        $user = User::findOrFail($userId);
        $user->first_name = $data['first_name'] ?? $user->first_name;
        $user->last_name = $data['last_name'] ?? $user->last_name;
        $user->email = $data['email'] ?? $user->email;
        $user->password = Hash::make($data['password']) ?? $user->password;
        $user->gender = $data['gender'] ?? $user->gender;
        $user->phone_number = $data['phone_number'] ?? $user->phone_number;
        $user->location = $data['location'] ?? $user->location;
        $user->location_details = $data['location_details'] ?? $user->location_details;
        $user->birthday = $data['birthday'] ?? $user->birthday;
        if (isset($data['user_picture']) && $data['user_picture']->isValid()) {
            // Delete the previous user picture if it exists
            if ($user->user_picture && Storage::exists($user->user_picture)) {
                Storage::delete($user->user_picture);
            }
    
            $extension = $data['user_picture']->getClientOriginalExtension();
            $pictureName = uniqid('userPic') . '.' . $extension;
            $picturePath = $data['user_picture']->storeAs('public/pictures', $pictureName);
            $user->user_picture = $picturePath;
        }
        $user->save();
        return $user;
    }

    /**
    * Delete User
    * @return User
    */
    public  function deleteUser($userId)
    {
        $user = User::find($userId);
        if (!$user)
            throw new \Exception(Translator::translate("USER.USER_NOT_FOUND"), 404);
        $user->delete();
        return $user;
    }

    /**
     * Get User Query.
     * @param User
     */
    public function getUserQuery()
    {
        return User::first();
    }

    /**
     * Get Pagination Data By Query.
     *
     */
    public  function getPaginationDataByQuery($data, $query)
    {
        $result = $query->paginate($data['per_page']);
        return $result;
    }

    /**
     * Get last inserted user.
     * @return User
     */
    public function getLastUser()
    {
        $user = User::orderBy('id')->first();
        return $user;
    }

    /**
     * Get All Users.
     * @return User
     */
    public function getAllUsers($data, $query)
    {
        return $query->paginate($data['per_page']);
    }

    /**
     * Get User By Id.
     * @return User
     */
    public function getUserById($data,$userId)
    {
        $user = User::findOrFail($userId);
        return $user;
    }
    
}
