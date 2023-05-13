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
 * Class GetAppointmentsByUserId
 *
 * @package Modules\Appointment\UseCases
 */
class GetAppointmentsByUserId
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
     * Get Appointments By User Id.
     * @return Appointment
     */
    public function execute($user_id)
    {
        try {
            $appointments = $this->appointmentRepository->getAppointmentsByUserId($user_id);
            return new UseCaseResult(ResponseStatus::successCode, new AppointmentResource($appointments), count($appointments), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
