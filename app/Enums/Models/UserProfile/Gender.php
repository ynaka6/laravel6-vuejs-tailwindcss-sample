<?php

namespace App\Enums\Models\UserProfile;

use BenSampo\Enum\Enum;
use Lang;

/**
 */
final class Gender extends Enum
{
    /** 回答しない/空欄 */
    const NotKnown  = 0;
    /** 男性 */
    const Male      = 1;
    /** 女性 */
    const Female    = 2;
    /** その他 */
    const Other     = 9;

    public static function getDescription($value): string
    {
        if (Lang::has('enum.models.user.profile.gender.' . $value)) {
            return Lang::get('enum.models.user.profile.gender.' . $value);
        }
        return parent::getDescription($value);
    }
}
