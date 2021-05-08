<?php

namespace App\Http\Requests;

use App\Traits\ResponseApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    use ResponseApi;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error(['errors' => $validator->errors()], 422));
    }
}
