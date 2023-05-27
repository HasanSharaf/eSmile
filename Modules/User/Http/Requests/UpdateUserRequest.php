<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Models\EUserGender;

class UpdateUserRequest extends FormRequest
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
                Rule::in(EUserGender::USER_ARR)
            ],
            'phone_number' => ['numeric','min:10'],
            'birthday' => ['date'],
            'location' => ['string','min:3','max:255'],
            'location_details' => ['string','min:3','max:255'],
            'user_picture' => ['nullable', 'image','max:2048'],
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
