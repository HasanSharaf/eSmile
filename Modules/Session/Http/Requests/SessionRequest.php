<?php

namespace Modules\Session\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Session\Models\EPaymentType;

class SessionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_cost' => 'required|integer',
            'paid' => 'required|integer',
            'description' => 'nullable|string',
            'payment_type' => ['required',Rule::in(EPaymentType::PAYMENT_ARR)],
            
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
