<?php

namespace Modules\Doctor\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\Http\Resources\DoctorResource;
use App\Models\ResponseStatus;
use Modules\Doctor\Http\Resources\DoctorLoginResource;

/**
 * Class Logout Doctor
 *
 * @package Modules\Doctor\UseCases
 */
class LogoutDoctor
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
     * logout Doctor.
     * @return Doctor
     */
    public function execute($request)
    {
        try {
            $doctor = $this->doctorRepository->logoutDoctor($request);
            return new UseCaseResult(ResponseStatus::successCode, 1, 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return response()->json(['error' => $message], 500);
        }
    }
  

}
