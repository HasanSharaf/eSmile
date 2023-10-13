<?php

namespace Modules\Appointment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'selected_date' => 'required|date_format:Y-m-d',
            'selected_time' => 'required|date_format:H:i',
            'note' => 'nullable|string',
            'doctor_id' => 'required|exists:doctors,id',   
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
