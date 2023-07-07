<?php

namespace Modules\Doctor\UseCases;

use App\Helpers\Classes\DefaultKeysHelper;
use App\Helpers\Classes\FilterHelper;
use App\Helpers\Classes\SearchQueryHelper;
use App\Helpers\Classes\SortHelper;
use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\Http\Resources\DoctorResource;
use App\Models\ResponseStatus;
use Modules\Doctor\Models\DoctorFilterKey;
use Modules\Doctor\Models\DoctorSortKey;

/**
 * Class GetALlDoctors
 *
 * @package Modules\Doctor\UseCases
 */
class GetAllDoctors
{

   private $doctorRepository ;
    /**
    * Class constructor
    *
    **/
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository= $doctorRepository;
      
    }

    /**
     * Get All Doctors.
     * @return Doctor
     */
    public function execute($request)
    {
        try {
            $data = DefaultKeysHelper::execute($request);
            $query = $this->doctorRepository->getDoctorQuery();
            $filter_data = SearchQueryHelper::execute($request, ['first_name', 'last_name', 'email', 'phone_number', 'gender', 'location', 'location_details', 'years_of_experience']);
            $filterQuery = FilterHelper::filter($filter_data, DoctorFilterKey::KEYS_ARR, $query);
            $sortQuery = SortHelper::sort($data['order_key'], $data['order'], DoctorSortKey::KEYS_ARR, $filterQuery);
            $result = $this->doctorRepository->getAllDoctors($data, $sortQuery);
            return new UseCaseResult(ResponseStatus::successCode, new DoctorResource($result, false), $result->count(), '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
