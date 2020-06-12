<?php

namespace App\Requests\Interfaces;

interface UpdateInput
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

    /**
     * バリデーションのフォームを取得
     *
     * @return array
     */
    public function validated(): array;
}
