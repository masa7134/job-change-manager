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
        'interview_round',
        'interview_status',
        'preparation_status'
    ];

    protected $casts = [
        'interview_round' => InterviewRound::class,
        'interview_status' => InterviewStatus::class,
        'preparation_status' => PreparationStatus::class,
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    // Enumのテキスト表現を取得
    public function getEnumText(string $column)
    {
        if (!isset($this->casts[$column]) || !method_exists($this->{$column}, 'text')) {
            throw new \InvalidArgumentException("Invalid Enum column: $column");
        }
        return $this->{$column}->text();// Enumのテキストを返す
    }
}
