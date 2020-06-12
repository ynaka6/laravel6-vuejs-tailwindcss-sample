<?php

namespace App\Requests\Interfaces;

interface PaginationInput
{
    /**
     * ログインユーザーのIDを取得
     *
     * @return array
     */
    public function all(): array;
}
