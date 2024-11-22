<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url', 'location', 'phone', 'email', 'status',
    ];

    protected $casts = [
        'status' => Status::class,// enumにキャスト
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
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

    //Enum値を取得
    public function getStatusAttribute($value)
    {
        return Status::fromValue($value); // Enum値として返す
    }

    // Enum値を保存する際にStatusを保存
    public function setStatusAttribute(Status $status)
    {
        $this->attributes['status'] = $status->value;// Enumの値を保存
    }

      // ステータスのテキスト表現を取得
    public function getStatusTextAttribute()
    {
        return $this->status->text();// Enumのテキストを返す
    }
}
