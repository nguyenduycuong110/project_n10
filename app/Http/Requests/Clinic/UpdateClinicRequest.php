<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'department_id' => 'gt:0',
            'user_id' => 'gt:0'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập phòng khám',
            'department_id.gt' => 'Bạn chưa chọn khoa bệnh',
            'user_id.gt' => 'Bạn chưa chọn bác sĩ',
        ];
    }
}
