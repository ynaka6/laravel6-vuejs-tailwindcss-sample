<?php

namespace App\Enums\Models\Employee;

use BenSampo\Enum\Enum;

/**
 * @method static static Appling()
 * @method static static Approved()
 */
final class Status extends Enum
{
    /** 申請中 */
    const Appling   = 1;
    /** 承認済 */
    const Approved  = 2;

    public static function getDescription($value): string
    {
        if (Lang::has('enum.models.employee.status.' . $value)) {
            return Lang::get('enum.models.employee.status.' . $value);
        }
        return parent::getDescription($value);
    }
}
