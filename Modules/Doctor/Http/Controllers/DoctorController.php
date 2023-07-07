<?php

namespace Modules\Doctor\Http\Controllers;

// use Modules\Doctor\UseCases\GetEnableFinancialDoctor;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Doctor\Http\Requests\LoginDoctorRequest;
use Modules\Doctor\Http\Requests\RegisterDoctorRequest;
use Modules\Doctor\Http\Requests\UpdateDoctorRequest;
use Modules\Doctor\Repositories\DoctorRepository;
use Modules\Doctor\UseCases\DeleteDoctor;
use Modules\Doctor\UseCases\GetAllDoctors;
use Modules\Doctor\UseCases\GetDoctorById;
use Modules\Doctor\UseCases\LoginDoctor;
use Modules\Doctor\UseCases\LogoutDoctor;
use Modules\Doctor\UseCases\RegisterDoctor;
use Modules\Doctor\UseCases\UpdateDoctor;

class DoctorController extends Controller
{
    private $doctorRepository;
    
    /**
     * Class constructor
     *
     **/
    public function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
        
    
    }

    /**
    * Create Doctor (Register).
    * @return Response
    */
    public function registerDoctor(RegisterDoctorRequest $request, RegisterDoctor $registerDoctor)
    {
        $result = $registerDoctor->execute($request);
        return $this->handleResponse($result);
    }

    /**
    * Login Doctor.
    * @return Response
    */
    public function loginDoctor(LoginDoctorRequest $request, LoginDoctor $loginDoctor)
    {
        $result = $loginDoctor->execute($request);
        return $this->handleResponse($result);
    }

    /**
    * Logout Doctor.
    * @return Response
    */
    public function logoutDoctor(Request $request, LogoutDoctor $logoutDoctor)
    {
        $result = $logoutDoctor->execute($request);
        return $this->handleResponse($result);
        
    }

    /**
    * Update Doctor.
    * @return Response
    */
    public function updateDoctor(UpdateDoctorRequest $request, $doctorId, UpdateDoctor $updateDoctor)
    {
        $result = $updateDoctor->execute($request,$doctorId);
        return $this->handleResponse($result);
        
    }

    /**
    * Delete Doctor.
    * @return Response
    */
    public function deleteDoctor($doctorId, DeleteDoctor $deleteDoctor)
    {
        $result = $deleteDoctor->execute($doctorId);
        return $this->handleResponse($result);
        
    }

    /**
    * Get All Doctors.
    * @return Response
    */
    public function getAllDoctors(Request $request, GetAllDoctors $getAllDoctors)
    {
        $result = $getAllDoctors->execute($request->all());
        return $this->handleResponse($result);
        
    }

    /**
    * Get Doctor By Id.
    * @return Response
    */
    public function getDoctorById(Request $request, $doctorId,GetDoctorById $getDoctorById)
    {
        $result = $getDoctorById->execute($request,$doctorId);
        return $this->handleResponse($result);
        
    }

    // /**
    // * Get Enable Financial Doctor.
    // * @return Response
    // */
    // public function getEnableFinancialDoctor(Request $request, GetEnableFinancialDoctor $getEnableFinancialDoctor)
    // {
    //     $result = $getEnableFinancialDoctor->execute($request->all());
    //     return $this->handleResponse($result);
        
    // }

}
