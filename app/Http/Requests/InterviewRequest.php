<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\InterviewRound;

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
        // ルートに応じて異なるバリデーションルールを設定
        $routeName = $this->route()->getName();
        // $applicationId = $this->route('application');// ルートパラメータからアプリケーションIDを取得

        // \Log::debug('Route Name: ' . $routeName);  // ルート名を確認
        // \Log::debug('Application ID: ' . $applicationId);

        $rules = [
            'application_id' => [
                'required',
                'integer',
                'exists:applications,id',// applicationsテーブルに存在するIDか確認
            ],
            'content' => 'nullable|string',
        ];

        // 面接日のバリデーションルール
        if ($routeName === 'interview.store') {
            // 新規作成時は今日以降の日付のみ許可
            $rules['interview_date'] = 'nullable|date|after_or_equal:today';
            $rules['interview_round'] = [
                'required',
                'integer',
                'in:' . implode(',', InterviewRound::getValues()),// 入力された値がenumの値に該当するかチェック
                // カスタムバリデーション関数（対象フィールド名、フォームから送信された値、エラーメッセージを設定するための関数）
                function($attribute, $value, $fail) {
                    $applicationId = $this->get('application_id');
                    // 同じアプリケーションで面接ラウンドが存在するかチェック
                    $exists = \App\Models\Interview::where('application_id', $applicationId)
                        ->where('interview_round', $value)
                        ->exists();

                    if($exists) {
                        $fail('この面接ラウンドはすでに登録されています。');
                    }
                }
            ];
        } else {
            // 更新時は過去の日付も許可
            $rules['interview_date'] = 'nullable|date';
        }

        return $rules;
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
            'interview_round' => '面接ラウンド',
            'content' => '内容',
        ];
    }

    public function messages(): array
    {
        return [
            'interview_round.required' => '面接ラウンドは必須です。',
            'interview_round.unique' => 'この面接ラウンドはすでに登録されています。',
            '*.string' => ':attribute は文字列でなければなりません。',
            '*.max' => ':attribute は最大 :max 文字までです。',
            'interview_date.date' => ':attribute は有効な日付形式でなければなりません。',
            'interview_date.after_or_equal' => ':attribute は今日以降の日付を指定してください。',
        ];
    }
}
