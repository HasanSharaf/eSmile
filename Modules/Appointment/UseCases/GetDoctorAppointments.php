<?php

namespace Modules\Appointment\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Appointment\Entities\Appointment;
use Modules\Appointment\Repositories\AppointmentRepository;
use Modules\Appointment\Http\Resources\AppointmentResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Modules\Appointment\Http\Resources\GetDoctorAppointmentResource;

/**
 * Class GetDoctorAppointments
 *
 * @package Modules\Appointment\UseCases
 */
class GetDoctorAppointments
{

   private $appointmentRepository ;
    /**
    * Class constructor
    *
    **/
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository= $appointmentRepository;
      
    }

    /**
     * Get Appointments By Doctor Id.
     * @return Appointment
     */
    public function execute($doctor_id, $selected_date)
    {
        try {
            $appointments = $this->appointmentRepository->getDoctorAppointments($doctor_id, $selected_date);
            if ($appointments->isEmpty()) {
                return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, 'No appointments found for the specified date.');
            }
            return new UseCaseResult(ResponseStatus::successCode, new GetDoctorAppointmentResource($appointments), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
    
    
  

}
