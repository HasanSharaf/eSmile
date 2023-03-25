<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [$this->required(),'min:1','max:191'],
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'nome',
        ];
    }
}
