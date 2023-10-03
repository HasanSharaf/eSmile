<?php

namespace Modules\Appointment\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Appointment\Entities\Appointment;
use Modules\Appointment\Repositories\AppointmentRepository;
use Modules\Appointment\Http\Resources\AppointmentResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;

/**
 * Class CreateAppointment
 *
 * @package Modules\Appointment\UseCases
 */
class CreateAppointment
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
     * Create Appointment.
     * @return Appointment
     */
    public function execute($user_id, $doctor_id, $data)
    {
        try {
            $appointment = $this->appointmentRepository->createAppointment($user_id, $doctor_id, $data);
            // dd($appointment);
            return new UseCaseResult(ResponseStatus::successCreate, new AppointmentResource([$appointment]), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
