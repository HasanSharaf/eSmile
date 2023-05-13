<?php

namespace Modules\Appointment\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Helpers\Classes\FilterHelper;
use App\Helpers\Classes\SearchQueryHelper;
use App\Helpers\Classes\SortHelper;
use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Appointment\Entities\Appointment;
use Modules\Appointment\Repositories\AppointmentRepository;
use Modules\Appointment\Http\Resources\AppointmentResource;
use App\Models\ResponseStatus;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\ToArray;
use Modules\Appointment\Models\AppointmentFilterKey;
use Modules\Appointment\Models\AppointmentSortKey;

/**
 * Class ListAppointment
 *
 * @package Modules\Appointment\UseCases
 */
class ListAppointments
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
     * List Appointment.
     * @return Appointment
     */
    public function execute($request)
    {
        try {
            $data = DefaultKeysHelper::execute($request);
            $query = $this->appointmentRepository->getAppointmentQuery();
            $filter_data = SearchQueryHelper::execute($request, ['first_name', 'last_name', 'email', 'phone_number', 'gender', 'location', 'location_details', 'selected_time', 'note']);
            $filterQuery = FilterHelper::filter($filter_data, AppointmentFilterKey::KEYS_ARR, $query);
            $sortQuery = SortHelper::sort($data['order_key'], $data['order'], AppointmentSortKey::KEYS_ARR, $filterQuery);

            $result = $this->appointmentRepository->getAllAppointments($data, $sortQuery);
            return new UseCaseResult(ResponseStatus::successCode, new AppointmentResource($result, false), $result->count(), '');
            
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
