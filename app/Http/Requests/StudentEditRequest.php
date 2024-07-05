<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentEditRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            "name"=> "regex:/^[\pL\s\-]+$/u|string|min:3|max:1000|required",
            "nis"=> [
                "required",
                "max_digits:5",
                "numeric",
                Rule::unique('students', 'nis')->ignore($id)
            ],
            "gender"=> ["required", Rule::in(['0', '1'])],
            "class"=> "required",
        ];
    }

    public function messages()
    {
        $id = $this->route('id');

        return [
            "name.required"=> "Nama harus di isi!",
            "name.regex"=> "Nama hanya boleh berisi alphabet dan spasi!",
            "name.max"=> "Nama tidak boleh melebihi :max karakter!",
            "nis.required"=> "Nis harus di isi!",
            "nis.unique"=> "Nis sudah digunakan!",
            "nis.max_digits"=> "Nis tidak boleh melebihi :max angka!",
            "nis.numeric"=> "Nis hanya boleh berisi angka!",
            "gender.required"=> "Gender harus di isi!",
            "gender.in"=> "Gender Tidak di temukan!",
            "class.required"=> "Kelas harus di isi!",
        ];
    }
}
