<?php

namespace App\Enums\Models\Admin;

use BenSampo\Enum\Enum;
use Lang;

/**
 * 管理ユーザーの権限
 *
 * @method static static Administrator()
 * @method static static Normal()
 */
final class Role extends Enum
{
    /** 管理者権限 */
    const Administrator =   1;
    /** 一般ユーザー */
    const Normal        =   2;


    public $color;

    public function __construct($enumValue)
    {
        parent::__construct($enumValue);
        $this->color = static::getColor($enumValue);
    }

    public static function getDescription($value): string
    {
        if (Lang::has('enum.models.admin.role.' . $value)) {
            return Lang::get('enum.models.admin.role.' . $value);
        }
        return parent::getDescription($value);
    }

    public static function getColor($value): string
    {
        if (Lang::has('enum.models.admin.role.color.' . $value)) {
            return Lang::get('enum.models.admin.role.color.' . $value);
        }
        return $value;
    }
}
