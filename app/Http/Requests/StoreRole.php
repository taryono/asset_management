<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
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
            'is_active' => 'required', 
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus di isi.', 
            'is_active.required' => 'Status harus di isi.', 
        ];
    }


}
