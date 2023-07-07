<?php

namespace Modules\Doctor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Doctor\Models\EDoctorGender;

class RegisterDoctorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string','max:50'],
            'last_name' => ['required', 'string','max:50'],
            'email' => ['required', 'string','email','unique:users','max:255'],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'min:8',
                'max:255'
            ],
            'gender' => [
                'required',Rule::in(EDoctorGender::DOCTOR_ARR)
            ],
            'phone_number' => ['required', 'numeric','min:10'],
            'years_of_experience' => ['required', 'numeric','max:99'],
            'birthday' => ['required', 'date'],
            'location' => ['required', 'string','min:3','max:255'],
            'location_details' => ['required', 'string','min:3','max:255'],
            'doctor_picture' => ['nullable', 'image','max:2048'],
            
        ];
    }

    /**
     * Determine if the doctor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
