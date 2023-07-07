<?php

namespace Modules\Doctor\UseCases;
 use App\Shared\UseCaseResult;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\Http\Resources\DoctorResource;
use App\Models\ResponseStatus;
use Modules\Doctor\Http\Resources\DoctorLoginResource;

/**
 * Class Login
 *
 * @package Modules\Doctor\UseCases
 */
class LoginDoctor
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
     * login Doctor.
     * @return Doctor
     */
    public function execute($request)
    {
        try {
            $doctor = $this->doctorRepository->loginDoctor($request);
            $token = $doctor->createToken('token-name')->plainTextToken;
           
            return new UseCaseResult(ResponseStatus::successCode, [new DoctorLoginResource([$doctor]),'token' => $token], 1, '');
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (config('app.debug')) {
                $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
            }
            return new UseCaseResult(ResponseStatus::baseErrorCode, null, 0, $message);
            return response()->json(['error' => $message], 500);
        }
    }
    // public function execute($request)
    // {
    //     try {
    //         $doctor = $this->doctorRepository->loginDoctor($request);
    //         $token = $doctor->createToken('token-name')->plainTextToken;
            
    //         return new UseCaseResult(ResponseStatus::successCode, [new DoctorLoginResource([$doctor]), 'token' => $token], 1, '');
    //     } catch (\Throwable $th) {
    //         $message = $th->getMessage();
    //         if (config('app.debug')) {
    //             $message .= ' in file: ' . $th->getFile() . ' line: ' . $th->getLine();
    //         }
    //         return response()->json(['error' => $message], 500);
    //     }
    // }


}
