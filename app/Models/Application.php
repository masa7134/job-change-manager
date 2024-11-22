<?php

namespace App\Models;

use App\Enums\ResumeStatus;
use App\Enums\WorkHistoryStatus;
use App\Enums\EntryFormStatus;
use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'resume_status',
        'work_history_status',
        'entry_form_status',
        'application_status'
    ];

    protected $casts = [
        'resume_status' => ResumeStatus::class,
        'work_history_status' => WorkHistoryStatus::class,
        'entry_form_status' => EntryFormStatus::class,
        'application_status' => ApplicationStatus::class
    ];

    // Companyとのリレーション
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    //Interviewとのリレーション
    public function interviews()
    {
        return $this->hasMany(Interview::class);
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
