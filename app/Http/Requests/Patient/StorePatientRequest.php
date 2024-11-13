<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'code' => 'required',
            'cid' => 'required|digits:12|unique:patients',
            'gender' => 'gt:0',
            'province_id' => 'gt:0'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên bệnh nhân',
            'name.string' => 'Tên bệnh nhân phải là dạng ký tự',
            'code.required' => 'Bạn chưa nhập mã bệnh nhân',
            'cid.required' => 'Bạn chưa nhập mã CCCD / CMND',
            'cid.digits' =>'Mã CCCD / CMND phải đúng 12 số',
            'cid.unique' => 'Mã CCCD / CMND đã tồn tại',
            'gender.gt' => 'Bạn chưa chọn giới tính',
            'province_id.gt' => 'Bạn chưa chọn tỉnh / thành phố'
        ];
    }
}
