<?php

namespace App\Models\Interfaces;

interface ShowModel
{
    /**
     * 検索処理
     *
     * @param array $condition;
     * @return void
     */
    public function firstByCondition(array $condition);
}
