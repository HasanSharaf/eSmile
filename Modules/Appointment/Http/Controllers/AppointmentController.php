<?php

namespace Modules\Appointment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Appointment\Http\Requests\CreateAppointmentRequest;
use Modules\Appointment\UseCases\CreateAppointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('appointment::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($user_id, CreateAppointmentRequest $request, CreateAppointment $createAppointment)
    {
        $result = $createAppointment->execute($user_id, $request->all());
        return $this->handleResponse($result);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('appointment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('appointment::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
