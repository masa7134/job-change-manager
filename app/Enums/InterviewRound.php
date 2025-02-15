<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 何時面接かを表すEnum
 * @method static static Casual()
 * @method static static First()
 * @method static static Second()
 * @method static static Third()
 * @method static static Fourth()
 */
final class InterviewRound extends Enum
{
    const Casual = 0;
    const First = 1;
    const Second = 2;
    const Third = 3;
    const Fourth = 4;

    /**
     * 面接ラウンドを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::Casual    => 'カジュアル面談',
            self::First   => '１次面接',
            self::Second   => '２次面接',
            self::Third   => '３次面接',
            self::Fourth   => '４次面接',
        };
    }

    /**
     * 次の面接ラウンドを取得
     *
     * @return InterviewRound
     */
    public function nextRound(): InterviewRound
    {
        return match ($this->value) {
            self::Casual => static::First(),
            self::First => static::Second(),
            self::Second => static::Third(),
            self::Third => static::Fourth(),
            self::Fourth => static::Fourth(), // 4回目以降は変化なし
            default => static::Casual(), // デフォルトはカジュアル面談
        };
    }
}
