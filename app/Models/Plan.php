<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'monthly_price',
        'display_monthly_price',
        'yearly_price',
        'display_yearly_price',
        'description_json',
    ];

    protected $casts = [
        'description_json' => 'json',
    ];
}
