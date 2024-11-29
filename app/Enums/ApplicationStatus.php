<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 書類提出状況を表すEnum
 * @method static static NotSubmitted()
 * @method static static Submitted()
 */
final class ApplicationStatus extends Enum
{
    const NotSubmitted = 0;
    const Submitted = 1;

    /**
     * 書類提出状況のワードを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::NotSubmitted    => '未提出',
            self::Submitted   => '提出済',
        };
    }

    public function color(): string
    {
        return match ($this->value) {
            self::NotSubmitted    => 'text-red-500',
            self::Submitted   => 'text-blue-500',
        };
    }
}
