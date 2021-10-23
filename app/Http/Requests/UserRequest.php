<?php

namespace App\Http\Requests;

use App\swagger\Requests\UserRequestInterface;

class UserRequest extends ApiRequest implements UserRequestInterface
{

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => filter_var($this->name, FILTER_SANITIZE_STRIPPED),
            'email' => filter_var($this->email, FILTER_SANITIZE_EMAIL),
        ]);
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                    'password_confirmation' => 'required|string|min:8'
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users'
                    ];
            default:
                break;
        }
    }
}
