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
    public function messages(): array
    {
        return [
            'address.string' => '住所は文字列でなければなりません。',
            'address.max' => '住所は最大255文字までです。',

            'phone_number.string' => '電話番号は文字列でなければなりません。',
            'phone_number.max' => '電話番号は最大20文字までです。',

            'email.email' => 'メールアドレスは正しい形式で入力してください。',
            'email.max' => 'メールアドレスは最大100文字までです。',

            'corporate_philosophy.string' => '企業理念は文字列でなければなりません。',

            'ceo_message.string' => '代表者の言葉は文字列でなければなりません。',

            'salary.string' => '給料は文字列でなければなりません。',
            'salary.max' => '給料は最大50文字までです。',

            'job_type.string' => '職種は文字列でなければなりません。',
            'job_type.max' => '職種は最大100文字までです。',

            'work_hours.string' => '勤務時間は文字列でなければなりません。',
            'work_hours.max' => '勤務時間は最大50文字までです。',

            'work_location.string' => '勤務地は文字列でなければなりません。',
            'work_location.max' => '勤務地は最大255文字までです。',

            'first_assignment.string' => '初回配属先は文字列でなければなりません。',
            'first_assignment.max' => '初回配属先は最大255文字までです。',
        ];
    }
}
