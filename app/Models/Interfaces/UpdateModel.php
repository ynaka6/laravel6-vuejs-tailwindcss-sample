<?php

namespace App\Models\Interfaces;

interface UpdateModel
{
    /**
     * 更新処理
     *
     * @param array $attributes;
     * @param array $options;
     * @return mixed
     */
    public function updateOrCreate(array $condition, array $attribute);
}
