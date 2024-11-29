<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'corporate_philosophy' => 'nullable|string',
            'ceo_message' => 'nullable|string',
            'salary' => 'nullable|string|max:50',
            'job_type' => 'nullable|string|max:100',
            'work_hours' => 'nullable|string|max:50',
            'work_location' => 'nullable|string|max:255',
            'first_assignment' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'address' => '住所',
            'phone_number' => '電話番号',
            'email' => 'メールアドレス',
            'corporate_philosophy' => '企業理念',
            'ceo_message' => '代表者の言葉',
            'salary' => '給料',
            'job_type' => '職種',
            'work_hours' => '勤務時間',
            'work_location' => '勤務地',
            'first_assignment' => '入社後最初の業務',
        ];
    }

    public function messages(): array
    {
        return [
            '*.string' => ':attribute は文字列でなければなりません。',
            '*.max' => ':attribute は最大 :max 文字までです。',
            'email.email' => ':attribute は正しい形式で入力してください。'
        ];
    }
}
