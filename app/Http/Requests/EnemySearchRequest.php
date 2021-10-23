<?php

namespace App\Http\Requests;

use App\swagger\Requests\EnemySearchRequestInterface;

class EnemySearchRequest extends ApiRequest implements EnemySearchRequestInterface
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
            'name' => "required|string|max:255"
        ];
    }
}
