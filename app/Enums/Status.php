<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 転職活動状況を表すEnum
 * @method static static InProgress()
 * @method static static Rejected()
 * @method static static UnofficialOffer()
 */
final class Status extends Enum
{
    const InProgress = 0;
    const Rejected = 1;
    const UnofficialOffer = 2;

    /**
     * 転職活動状況ワードを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::InProgress    => '進行中',
            self::Rejected   => '不採用',
            self::UnofficialOffer   => '内定',
        };
    }
}

