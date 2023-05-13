<?php

namespace Modules\Appointment\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Appointment\Entities\Appointment;
use Laravel\Sanctum\PersonalAccessToken;
use Modules\User\Entities\User;

class AppointmentRepository extends EloquentBaseRepository
{
    /**
    * Create Appointment
    * @return Appointment
    */
    public  function createAppointment($data)
    {
        // Retrieve user details
        $user = User::where('name', $data['user_name'])->firstOrFail();
        
        // Create appointment
        $appointment = Appointment::create([
            'user_id' => $user->id,
            'selected_time' => $data['selected_time'],
            'note' => $data['note'],
        ]);

        return $appointment;
    }

    /**
    * Update Appointment
    * @return Appointment
    */
    public  function updateAppointment($data,$userId)
    {
        $user = Appointment::findOrFail($userId);
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
    * Delete Appointment
    * @return User
    */
    public  function deleteAppointment($userId)
    {
        $user = Appointment::find($userId);
        if (!$user)
            throw new \Exception(Translator::translate("USER.USER_NOT_FOUND"), 404);
        $user->delete();
        return $user;
    }

    /**
     * get Appointment query.
     * @param Appointment
     */
    public function getAppointmentQuery()
    {
        $result = Appointment::orderBy('id', 'desc')->first();
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
     * get last inserted appointment.
     * @return Appointment
     */
    public function getLastAppointment()
    {
        $user = Appointment::orderBy('id', 'desc')->first();
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
