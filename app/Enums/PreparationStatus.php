<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 面接対策状況を表すEnum
 * @method static static NoCountermeasures()
 * @method static static MeasuresTaken()
 */
final class PreparationStatus extends Enum
{
    const NoCountermeasures = 0;
    const MeasuresTaken = 1;

    /**
     * 面接対策状況ワードを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::NoCountermeasures    => '未対策',
            self::MeasuresTaken   => '対策済',
        };
    }

    public function color(): string
    {
        return match ($this->value) {
            self::NoCountermeasures    => 'text-red-500',
            self::MeasuresTaken   => 'text-blue-500',
        };
    }
}
