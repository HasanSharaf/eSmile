<?php

namespace Modules\User\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentBaseRepository;
use Modules\User\Entities\User;

class UserRepository extends EloquentBaseRepository
{
    /**
    * Create User (Register)
    * @return User
    */
    public  function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],

        ]);

        $user->save();
        return $user;
    }

    // /**
    //  * get all user.
    //  * @return User
    //  */
    // public  function getAllUsers($data, $name)
    // {

    //     $query =  $this->model->query()
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
