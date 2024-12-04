<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 面接状況を表すEnum
 *
 * @method static static ScheduledDate()
 * @method static static Implemented()
 */
final class InterviewStatus extends Enum
{
    const ScheduledDate = 0;
    const Implemented = 1;

    /**
     * 面接状況ワードを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::ScheduledDate    => '予定',
            self::Implemented   => '実施済',
        };
    }

    public function color(): string
    {
        return match ($this->value) {
            self::ScheduledDate    => 'text-red-500',
            self::Implemented   => 'text-blue-500',
        };
    }
}
