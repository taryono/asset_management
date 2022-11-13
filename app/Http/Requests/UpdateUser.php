<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name' => 'required', 
            'email' => 'required|email',  
            'role_id' => 'required', 
        ];
    }

    public function messages()
    {  
        return [
            'name.required' => 'Nama Harus Diisi', 
            'email.required' => 'Email Harus Diisi', 
            'role_id.required' => 'Role Harus Pilih Salah Satu',  
        ];
    }
}
