<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
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
            'interview_date' => 'nullable|date|after_or_equal:today',
            'content' => 'nullable|string',
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
            'interview_date' => '面接日',
            'content' => '内容',
        ];
    }

    public function messages(): array
    {
        return [
            '*.string' => ':attribute は文字列でなければなりません。',
            '*.max' => ':attribute は最大 :max 文字までです。',
            'interview_date.date' => ':attribute は有効な日付形式でなければなりません。',
            'interview_date.after_or_equal' => ':attribute は今日以降の日付を指定してください。',
        ];
    }
}
