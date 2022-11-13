<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePage extends FormRequest
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

    public function rules()
    {
        return [
            'name'=> 'required',
            'is_publish'=> 'required',
            'publish_date'=> 'required',
            'type'=> 'required', 
            'sequence'=> 'required',
        ];
    }

    public function messages()
    {   
        return [
            'name.required'=> 'Nama Halaman harus diisi',
            'is_publish.required'=> 'Status Publish harus dipilih',
            'publish_date.required'=> 'Tanggal Publish harus diisi',
            'type.required'=> 'Tipe harus diisi', 
            'sequence.required'=> 'Urutan menu harus diisi',
        ];
    }
}
