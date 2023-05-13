<?php

namespace Modules\Appointment\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Modules\Appointment\Entities\Appointment;
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
        $user = User::where('id', $data['user_id'])->firstOrFail();
        
        // Create appointment
        $appointment = Appointment::create([
            'user_id' => $user->id,
            'selected_time' => $data['selected_time'],
            'note' => $data['note'],
        ]);

        return $appointment;
    }

    public function getAppointmentsByUserId($user_id)
    {
        return Appointment::where('user_id', $user_id)->get();
    }

    /**
    * Delete Appointment
    * @return Appointment
    */
    public  function deleteAppointment($id)
    {
        $appointment = Appointment::find($id);
        if (!$appointment)
            throw new \Exception(Translator::translate("APPOINTMENTS.APPOINTMENT_NOT_FOUND"), 404);
        $appointment->delete();
        return $appointment;
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
