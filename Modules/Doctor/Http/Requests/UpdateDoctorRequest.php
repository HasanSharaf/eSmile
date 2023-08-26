<?php

namespace Modules\Doctor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Doctor\Models\EDoctorGender;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['string','max:50'],
            'last_name' => ['string','max:50'],
            'email' => ['string','email','unique:users','max:255'],
            'password' => [
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'min:8',
            'max:255'
            ],
            'gender' => [
                Rule::in(EDoctorGender::DOCTOR_ARR)
            ],
            'phone_number' => ['numeric','min:10'],
            'phone_number' => ['numeric','max:99'],
            'birthday' => ['date'],
            'location' => ['string','min:3','max:255'],
            'location_details' => ['string','min:3','max:255'],
            'doctor_picture' => ['nullable', 'image','max:2048'],
            // 'competence_type' => ['nullable', 'image','max:2048'],
            // 'start_day' => ['nullable', 'image','max:2048'],
            // 'start_time' => ['nullable', 'image','max:2048'],
            // 'end_day' => ['nullable', 'image','max:2048'],
            // 'end_time' => ['nullable', 'image','max:2048'],
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
