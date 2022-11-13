<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsset extends FormRequest
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
            'name' => 'required',
            'asset_type_id' => 'required', 
            'asset_status_id' => 'required', 
            'asset_category_id' => 'required', 
            'amount' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus di isi.',
            'asset_type_id.required' => 'Tipe asset harus di isi.', 
            'asset_status_id.required' => 'Status asset harus di isi.', 
            'category_id.required' => 'Kategori asset harus diisi.', 
            'amount.required' => 'Jumlah asset harus diisi.'
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
