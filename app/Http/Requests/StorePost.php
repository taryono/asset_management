<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title'=> 'required',
            'post_status_id'=> 'required',
            'publish_date'=> 'required',
            'author'=> 'required', 
            'content'=> 'required',
        ];
    }

    public function messages()
    {   
        return [
            'title.required'=> 'Judul harus diisi',
            'post_status_id.required'=> 'Status Publish harus dipilih',
            'publish_date.required'=> 'Tanggal Publish harus diisi',
            'author.required'=> 'Nama Pengarang harus diisi', 
            'content.required'=> 'Kontent harus diisi',
        ];
    }
}
