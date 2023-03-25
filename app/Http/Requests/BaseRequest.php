<?php


namespace App\Http\Requests;

use App\Helpers\Classes\Response;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\Classes\Translator;
use App\Models\User;

class BaseRequest extends FormRequest
{
    use Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  this function resolve validation error message
     *
     * @param Validator $validator
     *
     * @return mixed|string
     * @throws \Exception
     * @author 
     */
    public function failedValidation(Validator $validator)
    {  
            throw new HttpResponseException(
                response()->json(
                    [
                        'data' => $validator->errors(),
                        'message' => Translator::translate("GENERAL.VALIDATION_ERROR"),
                        'error' => true,
                        'status' => 422
                        ]
                    , 422)
            );
       

        // parent::failedValidation($validator);
    // }          throw new \Exception($validator->errors());
       
    }

    /**
     *
     * @return string
     */
    public function required()
    {
        return $this->isUpdatedRequest() ? 'sometimes' : 'required';

    }

  

    private function isUpdatedRequest()
    {
        $method = strtolower(request()->method());

        return $method == 'put' || request()->method() == 'patch';
    }

    public function messages()
    {
        return [
            'code.unique'=>[Translator::translate("GENERAL.CODE_ALREADY_EXISTS")],
            '*.required'=>Translator::translate("GENERAL.REQUIRED_FIELD"),
        ];
    }

}
