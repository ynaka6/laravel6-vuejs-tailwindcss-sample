<?php

namespace App\Enums\Models\UserProfile;

use BenSampo\Enum\Enum;
use Lang;

/**
 * プロフィールの公開設定
 */
final class Status extends Enum
{
    /** 公開 */
    const Open          = 1;
    /** 社内公開 */
    const CompanyOpen   = 2;
    /** 非公開 */
    const Close   = 9;

    public static function getDescription($value): string
    {
        if (Lang::has('enum.models.user.profile.status.' . $value)) {
            return Lang::get('enum.models.user.profile.status.' . $value);
        }
        return parent::getDescription($value);
    }
}
