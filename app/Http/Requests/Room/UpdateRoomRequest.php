<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'name' => 'required|string',
            'department_id' => 'gt:0',
            'total_bed' => 'gt:0',
            'publish' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên phòng',
            'name.string' => 'Khoa bệnh phải là dạng ký tự',
            'department_id.gt' => 'Bạn chưa chọn khoa',
            'total_bed.gt' => 'Bạn chưa chọn số giường',
            'publish.required' => 'Bạn chưa chọn tình trạng phòng'
        ];
    }
}
