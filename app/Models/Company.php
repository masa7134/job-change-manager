<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
