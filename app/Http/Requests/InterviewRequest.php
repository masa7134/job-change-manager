<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\InterviewRound;
use App\Models\Interview;

use function PHPUnit\Framework\returnSelf;

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

        $rules = [
            'application_id' => [
                'required',
                'integer',
                'exists:applications,id',// applicationsテーブルに存在するIDか確認
            ],
            'content' => 'nullable|string',
        ];

        // 面接日時新規登録時のバリデーションルール
        if ($routeName === 'interview.store') {
            // 新規作成時は今日以降の日付のみ許可
            $rules['interview_datetime'] = [
                'required',
                'date',
                'after_or_equal:today',
                // カスタムルール(入力値が既存の面接より後であることを確認)
                function($attribute, $value, $fail) {
                    if (!$value) return; // 日付が空のときはカスタムルールをスキップ

                    // 新しい面接インスタンス作成
                    $interview = new Interview([
                        // 現在のリクエストからアプリケーションIDを取得
                        'application_id' => $this->get('application_id')
                    ]);

                    // 既存の面接データを取得
                    $existingInterviews = $interview->getPreviousInterviews();

                    // 既存の面接日時と比較
                    foreach ($existingInterviews as $existingInterview) {
                        // 入力値が既存の面接日時より前の日付ならエラー($failを実行)
                        if ($value <= $existingInterview->interview_datetime) {
                            $fail('面接日時は既存の面接日時 (' . $existingInterview->interview_datetime . ') 以前の日付は指定できません。 ');
                            break; // 一つでも違反があれば中断
                        }
                    }
                }
            ];

            // 面接ラウンドのルール
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
        // 更新時のルール
        } else {
            $rules['interview_datetime'] = [
                'nullable',
                'date',
                // カスタムバリデーション関数
                function($attribute, $value, $fail) {
                    if (!$value) return;

                    // アプリケーションIDを取得するための面接インスタンス作成
                    $interview = new Interview([
                        // 現在のリクエストからアプリケーションIDを取得
                        'application_id' => $this->get('application_id')
                    ]);

                    // 現在のアプリケーションIDの既存のインタビューを取得
                    $existingInterviews = $interview->getPreviousInterviews($this->route('interview'));

                    // 既存の面接日時と比較
                    foreach ($existingInterviews as $existingInterview) {
                        // 入力値が既存の面接日時より前の日付ならエラー($failを実行)
                        if ($value <= $existingInterview->interview_datetime) {
                            $fail('面接日時は既存の面接日時 (' . $existingInterview->interview_datetime . ') 以前の日付は指定できません。 ');
                            break; // 一つでも違反があれば中断
                        }
                    }
                }
            ];
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
            'interview_datetime' => '面接日時',
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
            'interview_datetime.required' => '面接日時を入力してください。',
            'interview_datetime.date' => ':attribute は有効な日時でなければなりません。',
            'interview_datetime.after_or_equal' => ':attribute は今日以降の日付を指定してください。',
            'interview_datetime.after_existing' => '面接日時は既存の面接日時より前の日付は指定できません',
        ];
    }
}
