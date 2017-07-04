<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use InfyOm\Generator\Request\APIRequest;

class RegisterRequest extends APIRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //todo: add role
            'phone' => 'numeric',
            'email' => 'email',
            'password' => 'required'
        ];
    }
}
