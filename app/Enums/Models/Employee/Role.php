<?php

namespace App\Enums\Models\Employee;

use BenSampo\Enum\Enum;

/**
 * @method static static Administrator()
 * @method static static Normal()
 */
final class Role extends Enum
{
    /** 管理者権限 */
    const Administrator =   1;
    /** 一般ユーザー */
    const Normal        =   2;

    public static function getDescription($value): string
    {
        if (Lang::has('enum.models.employee.role.' . $value)) {
            return Lang::get('enum.models.employee.role.' . $value);
        }
        return parent::getDescription($value);
    }
}
