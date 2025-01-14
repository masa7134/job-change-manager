<?php

namespace App\Models;

use App\Enums\InterviewRound;
use App\Enums\InterviewStatus;
use App\Enums\PreparationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'interview_datetime',
        'interview_round',
        'interview_status',
        'preparation_status',
        'content',
    ];

    protected $casts = [
        'interview_datetime' => 'datetime',
        'interview_round' => InterviewRound::class,
        'interview_status' => InterviewStatus::class,
        'preparation_status' => PreparationStatus::class,
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    // ステータスのインスタンスを取得
    public static function getStatuses()
    {
        return [
            'interview_round' => InterviewRound::getInstances(),
            'interview_status' => InterviewStatus::getInstances(),
            'preparation_status' => PreparationStatus::getInstances(),
        ];
    }

    // Enumのテキスト表現を取得
    public function getEnumText(string $column)
    {
        if (!isset($this->casts[$column]) || !method_exists($this->{$column}, 'text')) {
            throw new \InvalidArgumentException("Invalid Enum column: $column");
        }
        return $this->{$column}->text();// Enumのテキストを返す
    }

    // 【バリデーション用】既に登録されているの面接を取得(引数は除外するIDとする、初期値はnull)
    public function getPreviousInterviews($excludeId = null)
    {
        $query = $this->application
            ->interviews()
            ->whereNotNull('interview_datetime') // 日付が設定されている面接
            ->orderBy('interview_datetime', 'desc');

        // 特定の面接ID(編集中のID)を除外
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->get();
    }

    // 【ナビゲーションリンク用】メソッド名の頭に動詞はつけるべきですか？
    public function previousInterview()
    {
        return $this->application->interviews()
            ->where('interview_round', '<', $this->interview_round->value)
            ->orderBy('interview_round', 'desc')
            ->first();
    }

    // 【ナビゲーションリンク用】メソッド名の頭に動詞はつけるべきですか？
    public function nextInterview()
    {
        return $this->application->interviews()
        ->where('interview_round', '>', $this->interview_round->value)
        ->orderBy('interview_round', 'asc')
        ->first();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (isset($attributes['interview_round'])) {
            $this->attributes['interview_round'] = $attributes['interview_round'];
        }
    }
}
