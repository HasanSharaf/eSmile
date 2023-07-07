<?php

namespace Modules\Doctor\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\Http\Resources\DoctorResource;
use App\Models\ResponseStatus;

/**
 * Class UpdateDoctor
 *
 * @package Modules\Doctor\UseCases
 */
class UpdateDoctor
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
     * Update Doctor.
     * @return Doctor
     */
    public function execute($data,$doctorId)
    {
        try {
            $doctor = $this->doctorRepository->UpdateDoctor($data,$doctorId);
            return new UseCaseResult(ResponseStatus::successCode, new DoctorResource([$doctor]), 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
