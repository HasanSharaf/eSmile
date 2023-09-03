<?php

namespace Modules\User\Http\Requests;

use App\Models\ESelectType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Models\EUserGender;
use Modules\User\Models\EUserClinicKnowledge;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'min:8',
                'max:255'
            ],
            'gender' => [
                'required', Rule::in(EUserGender::USER_ARR)
            ],
            'phone_number' => ['required', 'numeric', 'min:10'],
            'birthday' => ['required', 'date'],
            'location' => ['required', 'string', 'min:3', 'max:255'],
            'location_details' => ['required', 'string', 'min:3', 'max:255'],
            'user_picture' => ['nullable', 'image', 'max:2048'],
        ];

        if ($this->input('clinic_knowledge') === EUserClinicKnowledge::ETC) {
            $rules['clinic_note'] = ['required'];
        }

        if (in_array($this->input('sensitive'), [ESelectType::YES, ESelectType::MAYBE, ESelectType::DONT_KNOW])) {
            $rules['sensitive_note'] = ['required'];
        }

        return $rules;
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
