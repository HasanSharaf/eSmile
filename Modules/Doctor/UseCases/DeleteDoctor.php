<?php

namespace Modules\Doctor\UseCases;

use App\Helpers\Classes\Translator;
use App\Shared\UseCaseResult;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\Http\Resources\DoctorResource;
use App\Models\ResponseStatus;

/**
 * Class DeleteDoctor
 *
 * @package Modules\Doctor\UseCases
 */
class DeleteDoctor
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
     * Delete Doctor.
     * @return Doctor
     */
    public function execute($doctorId)
    {
        try {
            $doctor = $this->doctorRepository->deleteDoctor($doctorId);
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
