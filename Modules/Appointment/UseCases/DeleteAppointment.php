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
 * Class DeleteAppointment
 *
 * @package Modules\Appointment\UseCases
 */
class DeleteAppointment
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
     * Delete Appointment.
     * @return Appointment
     */
    public function execute($id)
    {
        try {
            $appointments = $this->appointmentRepository->deleteAppointment($id);
            return new UseCaseResult(ResponseStatus::successCode,(Translator::translate('GENERAL.DELETED_SUCCESSFULLY')), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
