<?php

namespace App\Models\Interfaces;

interface DeleteModel
{
    /**
     * 削除処理
     *
     * @param array $condition;
     * @return void
     */
    public function deleteByCondition(array $condition): void;
}
