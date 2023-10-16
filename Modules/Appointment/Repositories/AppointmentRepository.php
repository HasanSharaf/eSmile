<?php

namespace Modules\Appointment\Repositories;

use App\Helpers\Classes\Translator;
use App\Repositories\EloquentBaseRepository;
use Modules\Appointment\Entities\Appointment;
use Modules\Doctor\Entities\Doctor;
use Modules\User\Entities\User;

class AppointmentRepository extends EloquentBaseRepository
{
    /**
    * Create Appointment
    * @return Appointment
    */
    public  function createAppointment($user_id, $doctor_id, $data)
    {
        try {
            $user = User::findOrFail($user_id);
            $data['doctor_id'] = $doctor_id;
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("USERS.USER_NOT_FOUND"), 404);
        }
        $data = $user->appointment()->create($data);
        return $data;
    }

    /**
    * Create Appointment From Doctor
    * @return Appointment
    */
    public  function createAppointmentFromDoctor($user_id, $doctor_id, $data)
    {
        try {
            $doctor = Doctor::findOrFail($doctor_id); // Note: Find doctor, not user
            $data['user_id'] = $user_id;
        } catch (\Throwable $th) {
            throw new \Exception(Translator::translate("DOCTORS.DOCTOR_NOT_FOUND"), 404);
        }
        $data = $doctor->appointment()->create($data);
        return $data;
    }
    
    /**
    * Get Appointments By User Id
    * @return Appointment
    */
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
    * List Appointment
    * @return Appointment
    */
    public function getAllAppointments($data, $query)
    {
        return $query->paginate($data['per_page']);
    }


    /**
     * get Appointment query.
     * @param Appointment
     */
    public function getAppointmentQuery()
    {
        return Appointment::with(['user','doctor']);
    }

    /**
    * Get Appointments By Doctor Id
    * @return Appointment
    */
    public function getDoctorAppointments($selected_date)
    {
        return Appointment::where('selected_date', '=', $selected_date)->get();
    }

}
