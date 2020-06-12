<?php

namespace App\Enums\Models\UserProfileSite;

use BenSampo\Enum\Enum;
use Lang;

/**
 */
final class Providor extends Enum
{
    /** Facebook */
    const Facebook  = 'facebook';
    /** Twitter */
    const Twitter   = 'twitter';
    /** Instagram */
    const Instagram = 'instagram';
    /** Eight */
    const Eight     = 'eight';
    /** Personal */
    const Personal  = 'personal';

    public $icon;

    public function __construct($enumValue)
    {
        parent::__construct($enumValue);
        $this->icon = static::getIcon($enumValue);
        $this->orderBy = static::getOrderBy($enumValue);
    }

    public static function getDescription($value): string
    {
        if (Lang::has('enum.models.user.profile.site.providor.' . $value)) {
            return Lang::get('enum.models.user.profile.site.providor.' . $value);
        }
        return parent::getDescription($value);
    }

    public static function getIcon($value): array
    {
        if (Lang::has('enum.models.user.profile.site.providor.icon.' . $value)) {
            return Lang::get('enum.models.user.profile.site.providor.icon.' . $value);
        }
        return $value;
    }

    public static function getOrderBy($value): int
    {
        if (Lang::has('enum.models.user.profile.site.providor.order_by.' . $value)) {
            return (int) Lang::get('enum.models.user.profile.site.providor.order_by.' . $value);
        }
        return 0;
    }
}
