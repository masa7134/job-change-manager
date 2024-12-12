<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppliationRequest extends FormRequest
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
            'resume_status' => 'required|integer',
            'work_history_status' => 'required|integer',
            'entry_form_status' => 'required|integer',
            'application_status' => 'required|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'resume_status' => '履歴書作成状況',
            'work_history_status' => '職務経歴書作成状況',
            'entry_form_status' => 'エントリーフォーム入力状況',
            'application_status' => '応募状況',
        ];
    }
}
