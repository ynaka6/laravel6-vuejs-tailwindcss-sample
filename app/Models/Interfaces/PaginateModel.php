<?php

namespace App\Models\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateModel
{
    /**
     * 指定された条件を元にページングのデータを取得します
     *
     * @param array $condition;
     * @return LengthAwarePaginator
     */
    public function paginateByCondition(array $condition): LengthAwarePaginator;
}
