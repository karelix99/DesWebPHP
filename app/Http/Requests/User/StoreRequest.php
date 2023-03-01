<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'user_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users,email',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return[
            'user_name.required' => 'Campo de nombre de usuario requerido',
            'user_name.max' => 'required|string|max:255',
            'dob.required' => 'required|date',
            'dob.date' => 'required|date',
            'email.required' => 'required|string|email|max:255|unique:users,email',
            'email.email' => 'required|string|email|max:255|unique:users,email',
            'email.max' => 'required|string|email|max:255|unique:users,email',
            'email.unique' => 'El correo ya existe.',
            'profile_pic.image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_pic.max' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'profile_pic.mimes' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ];
    }
}
