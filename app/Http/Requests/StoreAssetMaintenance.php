<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetMaintenance extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'asset_id' => 'required',  
            'actions' => 'required', 
            'cost' => 'required',
            'supplier_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [ 
            'asset_id.required' => 'Asset harus di isi.',  
            'actions.required' => 'Tindakan harus diisi.', 
            'supplier_id.required' => 'Supplier asset harus diisi.',
            'start.required' => 'Tanggal Masuk Servis harus diisi.', 
            'end.required' => 'Tanggal Selesai Servis harus diisi.',
            'description' => 'required'
        ];
    }
  
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }
}
