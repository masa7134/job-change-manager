<?php

namespace App\Models;

use App\Enums\Status;
use App\Enums\InterviewStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;// クエリビルダーを使用するための機能をインポート
use Illuminate\Support\Facades\DB;// データベース操作のためえの機能をインポート

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'status',
        'url',
        'address',
        'phone_number',
        'email',
        'corporate_philosophy',
        'ceo_message',
        'job_type',
        'salary',
        'work_hours',
        'work_location',
        'first_assignment',
    ];

    protected $casts = [
        'status' => Status::class,// enumにキャスト
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->hasOne(Application::class);
    }

    // ステータスのインスタンスを取得
    public static function getStatuses()
    {
        return Status::getInstances();
    }

      // Enumのテキスト表現を取得
    public function getEnumText(string $column)
    {
        if (!isset($this->casts[$column]) || !method_exists($this->{$column}, 'text')) {
            throw new \InvalidArgumentException("Invalid Enum column: $column");
        }
        return $this->{$column}->text();// Enumのテキストを返す
    }

    // 進捗状況管理画面で企業の並び順を制御するメソッド
    // クエリスコープという機能で、scopeという接頭辞をつけることでCompany::sortByProgressとして呼び出せる。
    // 引数にクエリビルダーのインスタンスを受取り戻り値もビルダーであることを指定
    public function scopeSortByProgress(Builder $query): Builder
    {
        return $query
            ->select([
                'companies.*',
                //進捗状況のカウント
                DB::raw('(
                    SELECT
                        SUM(CASE WHEN a.resume_status = 1 THEN 1 ELSE 0 END) +
                        SUM(CASE WHEN a.work_history_status = 1 THEN 1 ELSE 0 END) +
                        SUM(CASE WHEN a.entry_form_status = 1 THEN 1 ELSE 0 END) +
                        SUM(CASE WHEN a.application_status = 1 THEN 1 ELSE 0 END)
                    FROM applications a
                    WHERE a.company_id = companies.id
                ) as progress_count'),
                // 予定面接があるかどうかのフラグ
                DB::raw('EXISTS(
                    SELECT 1
                    FROM applications a
                    JOIN interviews i ON i.application_id = a.id
                    WHERE a.company_id = companies.id
                    AND i.interview_status = ' .InterviewStatus::Schedule . '
                    AND i.interview_date >= CURRENT_DATE
                ) as has_upcoming_interview'),
                // 最も近い面接予定日を取得
                DB::raw('(
                    SELECT MIN(i.interview_date)
                    FROM applications a
                    JOIN interviews i ON i.application_id = a.id
                    WHERE a.company_id = companies.id
                    AND i.interview_status = ' .InterviewStatus::Schedule . '
                    AND i.interview_date >= CURRENT_DATE
                ) as next_interview_date'),
            ])
            ->where('status', 0)  // 進行中を表す値（0）
            ->orderBy('has_upcoming_interview', 'desc')  // 面接予定があるものを優先
            ->orderBy('next_interview_date', 'asc')  // 面接予定日が近い順
            ->orderBy('progress_count', 'desc')  // 進捗状況が進んでいるものを上位に
            ->orderBy('updated_at', 'desc');  // 同じ進捗状況の場合は更新日時降順
    }
}
