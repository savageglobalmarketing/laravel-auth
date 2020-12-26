<?php

namespace SavageGlobalMarketing\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SavageGlobalMarketing\Foundation\Traits\ValidPagination;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tenant_name' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:auth_users,email'],
            'password' => ['required', 'max:255', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'max:255'],
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
