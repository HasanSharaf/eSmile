<?php

namespace Modules\Doctor\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\Http\Resources\DoctorResource;
use App\Models\ResponseStatus;

/**
 * Class Register Doctor
 *
 * @package Modules\Doctor\UseCases
 */
class RegisterDoctor
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
     * register Doctor.
     * @return Doctor
     */
    public function execute($request)
    {
        try {
            $doctor = $this->doctorRepository->registerDoctor($request);
            $token = $doctor->createToken('token-name')->plainTextToken;

            return new UseCaseResult(ResponseStatus::successCreate, [new DoctorResource([$doctor]),'token' => $token], 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
        }
    }
  

}
