<?php

namespace App\Requests\Interfaces;

interface DeleteInput
{
    /**
     * IDを取得
     *
     * @return int id
     */
    public function id(): int;

    /**
     * ログインユーザーのIDを取得
     *
     * @return ?int id
     */
    public function userId(): ?int;
}
