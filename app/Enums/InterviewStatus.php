<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 面接状況を表すEnum
 *
 * @method static static Schedule()
 * @method static static Implemented()
 */
final class InterviewStatus extends Enum
{
    const Schedule = 0;
    const Implemented = 1;

    /**
     * 面接状況ワードを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::Schedule    => '予定',
            self::Implemented   => '実施済',
        };
    }

    public function color(): string
    {
        return match ($this->value) {
            self::Schedule    => 'text-red-500',
            self::Implemented   => 'text-blue-500',
        };
    }
}
