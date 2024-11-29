<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 *  エントリーフォーム入力状況を表すEnum
 * @method static static NotEntered()
 * @method static static Entered()
 * @method static static NotApplicable()
 */
final class EntryFormStatus extends Enum
{
    const NotEntered = 0;
    const Entered = 1;
    const NotApplicable = 2;

    /**
     * エントリーフォーム入力状況のワードを取得
     *
     * @return string
     */
    public function text(): string
    {
        return match ($this->value) {
            self::NotEntered    => '未入力',
            self::Entered   => '入力済',
            self::NotApplicable   => '非該当',
        };
    }

    public function color(): string
    {
        return match ($this->value) {
            self::NotEntered    => 'text-red-500',
            self::Entered   => 'text-blue-500',
            self::NotApplicable   => 'text-blue-500',
        };
    }
}
