<?php

namespace App\Enums\Models\Company;

use BenSampo\Enum\Enum;

/**
 * プランのスラグ
 */
final class PlanSlug extends Enum
{
    const Free      = 'free';
    const Rakuraku  = 'rakuraku';
    const Lite      = 'lite';
    const Basic     = 'basic';
    const Premium   = 'premium';
}
