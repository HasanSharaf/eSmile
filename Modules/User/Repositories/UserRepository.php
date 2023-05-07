<?php

namespace Modules\User\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Laravel\Sanctum\PersonalAccessToken;


class UserRepository extends EloquentBaseRepository
{
    /**
    * Create User (Register)
    * @return User
    */
    public  function register($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            'location' => $data['location'],
            'location_details' => $data['location_details'],

        ]);
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
     * get Quotation query.
     * @param Quotation
     */
    public function getUserQuery()
    {
        $result = User::orderBy('id', 'desc')->first();
        return $result;
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
     * get last inserted user.
     * @return User
     */
    public function getLastUser()
    {
        $user = User::orderBy('id', 'desc')->first();
        return $user;
    }

    // /**
    // * Get All Users.
    // * @return User
    // */
    // public  function getAllUsers($userId)
    // {
    //     $user = User::find($userId);
    //     if (!$user)
    //         throw new \Exception(Translator::translate("USER.USER_NOT_FOUND"), 404);
    //     $user->delete();
    //     return $user;
    // }

    

    // /**
    //  * get all user.
    //  * @return User
    //  */
    // public  function getAllUsers($data, $name)
    // {

    //     $query =  User::query()
    //         ->when($name, function ($query) use ($name) {
    //             $query->where('name', 'like', '%' . $name . '%');
    //         });
    //     return $query->paginate($data['per_page']);
    // }


    // /**
    //  * edit a  user.
    //  * @param Request $request
    //  * @return user
    //  */
    // public function edit($data, $id)
    // {
    //     $user = $this->model->find($id)->update([]);
    //     return $user;
    // }

    // /**
    //  * delet a  user.
    //  * @param Request $request
    //  * @return User
    //  */
    // public function deleteUser($id)
    // {
    //     $user = $this->model->find($id)->delete();
    //     return $user;
    // }

    // /**
    //  * get a user by id.
    //  * @return User
    //  */
    // public  function getUserById($id)
    // {
    //     $user = $this->model->find($id);
    //     if (!$user)
    //         throw new \Exception(Translator::translate('USERS.USER_NOT_FOUND'), 404);

    //     return  $user;
    // }

    // /**
    //  * Get List of users
    //  * @return User
    //  */
    // public function listQuotationIntialdata()
    // {
    //     $result = $this->model->whereIn('tipo', EQuotationClientType::CLIENT_TYPES_ARR)->select('id', 'name', 'vat', 'tipo')->get();
    //     return  $result;
    // }

}
