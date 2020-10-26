<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'     => ['required', 'string', 'min:5', 'max:15'],
            'password' => ['required', 'confirmed', 'min:8', 'max:100', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[&-_.!@#$%*?+~])/'],
            'email'    => ['required', 'email', 'unique:users,email'],
        ];
    }
}
