<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 履歴書作成状況を表すEnum
 *
 * @method static static NotCreated()
 * @method static static Created()
 */
final class ResumeStatus extends Enum
{
    const NotCreated = 0;
    const Created = 1;

    /**
     * 履歴書作成状況のワードを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::NotCreated    => '未作成',
            self::Created   => '作成済',
        };
    }

    public function color(): string
    {
        return match ($this->value) {
            self::NotCreated    => 'text-red-500',
            self::Created   => 'text-blue-500',
        };
    }
}
