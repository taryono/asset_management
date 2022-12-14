<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetDetail extends FormRequest
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
            'employee_id' => 'required',  
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus di isi.',
            'employee_id.required' => 'Nama orang harus di isi.',  
        ];
    }
}
