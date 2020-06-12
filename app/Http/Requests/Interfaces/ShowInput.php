<?php

namespace App\Requests\Interfaces;

interface ShowInput
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
