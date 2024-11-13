<?php

namespace App\Http\Requests\Bed;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBedRequest extends FormRequest
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
            'room_id' => 'gt:0',
            'publish' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập Giường bệnh',
            'name.string' => 'Giường bệnh phải là dạng ký tự',
            'room.gt' => 'Bạn chưa chọn phòng bệnh',
            'publish.required' => 'Bạn chưa chọn trạng thái'
        ];
    }
}
