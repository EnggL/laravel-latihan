<?php

namespace App\Http\Requests;

use App\Models\Teacher;
use Illuminate\Foundation\Http\FormRequest;

class ClassStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'class' => 'required',
            'wali' => 'required|exists:teachers,id',
        ];
    }

    public function messages()
    {
        return [
            'class.required' => 'Nama Kelas Tidak Boleh Kosong!',
            'wali.required'=> 'Wali Kelas Tidak Boleh Kosong!' ,
            'wali.exists'=> 'Wali Kelas Tidak di Temukan!' ,
        ];
    }
}
