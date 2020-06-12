<?php

namespace App\Models\Interfaces;

interface CreateModel
{
    /**
     * 登録処理
     *
     * @param array $attributes;
     * @return mixed
     */
    public function create(array $attributes);
}
