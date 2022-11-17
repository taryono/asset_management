<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'password' => 'required|min:8', 
            'password_confirm' => 'required|same:password|min:8', 
            'role_id' => 'required', 
        ];
    }

    public function messages()
    {  
        return [
            'name.required' => 'Nama Harus Diisi', 
            'email.required' => 'Email Harus Diisi', 
            'role_id.required' => 'Role Harus Pilih Salah Satu', 
            'password.required' => 'Password Harus Diisi', 
            'password.min' => 'Password Harus 8 Atau Lebih Karakter', 
            //'password_confirm.required' => 'Konfirmasi Password Harus Diisi', 
            //'password_confirm.min' => 'Konfirmasi Password Harus 8 Atau Lebih Karakter', 
            //'password_confirm.same' => 'Konfirmasi Password Harus Sama Dengan Password', 
        ];
    }
}
