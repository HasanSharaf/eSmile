<?php

namespace Modules\Appointment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Appointment\Http\Requests\CreateAppointmentRequest;
use Modules\Appointment\Repositories\AppointmentRepository;
use Modules\Appointment\UseCases\CreateAppointment;

class AppointmentController extends Controller
{
    private $appointmentRepository;
    
    /**
     * Class constructor
     *
     **/
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
        
    
    }

    /**
    * Create Appointment.
    * @return Response
    */
    public function createAppointment(CreateAppointmentRequest $request, $user_id, CreateAppointment $createAppointment)
    {
        $result = $createAppointment->execute($request, $user_id);
        return $this->handleResponse($result);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  * @param Request $request
    //  * @return Renderable
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Show the specified resource.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function show($id)
    // {
    //     return view('appointment::show');
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function edit($id)
    // {
    //     return view('appointment::edit');
    // }

    // /**
    //  * Update the specified resource in storage.
    //  * @param Request $request
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
