<?php

namespace Modules\Appointment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Appointment\Http\Requests\CreateAppointmentRequest;
use Modules\Appointment\Repositories\AppointmentRepository;
use Modules\Appointment\UseCases\CreateAppointment;
use Modules\Appointment\UseCases\GetAppointmentsByUserId;

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
    public function createAppointment(CreateAppointmentRequest $request, $user_id, CreateAppointment $createAppointment)
    {
        $result = $createAppointment->execute($request, $user_id);
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

}
