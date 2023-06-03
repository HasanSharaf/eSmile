<?php

namespace Modules\Appointment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Appointment\Http\Requests\CreateAppointmentRequest;
use Modules\Appointment\Repositories\AppointmentRepository;
use Modules\Appointment\UseCases\CreateAppointment;
use Modules\Appointment\UseCases\DeleteAppointment;
use Modules\Appointment\UseCases\GetAppointmentsByUserId;
use Modules\Appointment\UseCases\ListAppointment;
use Modules\Appointment\UseCases\ListAppointments;

class AppointmentController extends Controller
{
    private $appointmentRepository;
    
    /**
     * Class constructor
     *
     **/
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
        
    
    }

    /**
    * Create Appointment.
    * @return Response
    */
    public function createAppointment($user_id ,CreateAppointmentRequest $request ,CreateAppointment $createAppointment)
    {
        $result = $createAppointment->execute($user_id,$request->all());
        return $this->handleResponse($result);
    }

    /**
    * Get User Appointments.
    * @return Response
    */
    public function getUserAppointments($user_id, GetAppointmentsByUserId $getAppointmentsByUserId)
    {
        $result = $getAppointmentsByUserId->execute($user_id);
        return $this->handleResponse($result);
    }

    /**
    * Delete Appointment.
    * @return Response
    */
    public function deleteAppointment($id, DeleteAppointment $deleteAppointment)
    {
        $result = $deleteAppointment->execute($id);
        return $this->handleResponse($result);
    }

    /**
    * List Appointment.
    * @return Response
    */
    public function listAppointments(Request $request, ListAppointments $listAppointments)
    {
        $appointments = $listAppointments->execute($request->all());
        return $this->handleResponse($appointments);
    }

}
