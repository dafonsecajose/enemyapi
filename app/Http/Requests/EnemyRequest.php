<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnemyRequest extends FormRequest
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
            'name' => 'required|unique:enemies',
            'rank' => 'required',
            'level' => 'required',
            'affiliation' => 'required',
            'description'=> 'required',
            'images.*' => 'mimes:jpg,png,jpeg'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => filter_var($this->name, FILTER_SANITIZE_STRIPPED),
            'rank' => filter_var($this->rank, FILTER_SANITIZE_STRIPPED),
            'level' => filter_var($this->level, FILTER_SANITIZE_STRIPPED),
            'affiliation' => filter_var($this->affiliation, FILTER_SANITIZE_STRIPPED),
            'description'=> filter_var($this->description, FILTER_SANITIZE_STRIPPED),
        ]);
    }
}
