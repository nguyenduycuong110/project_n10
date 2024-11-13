<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
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
            'expense_catalogue_id' => 'gt:0',
            'price' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập dịch vụ',
            'name.string' => 'Dịch vụ phải là dạng ký tự',
            'expense_catalogue_id.gt' => 'Bạn chưa chọn nhóm dịch vụ',
            'price.required' => 'Bạn chưa nhập giá'
        ];
    }
}
