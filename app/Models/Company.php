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
        'url',
        'address',
        'phone_number',
        'email',
        'status',
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

    // // APIからのデータ自動入力時にstatusをEnumとして適用
    // public static function createFromApiData(array $data)
    // {
    //     // statusが数値の場合、Enumに変換してから保存
    //     if (isset($data['status'])) {
    //         $data['status'] = Status::fromValue($data['status']);
    //     }

    //     // APIから取得した企業情報をそのまま保存
    //     return self::create($data);
    // }

    //ステータスのインスタンスを取得
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
