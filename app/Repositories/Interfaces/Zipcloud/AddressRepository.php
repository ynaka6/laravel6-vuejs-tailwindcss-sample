<?php

namespace App\Repositories\Interfaces\Zipcloud;

/**
 * ZipcloudのAPIを利用して、郵便番号から住所を取得します。
 *
 * http://zipcloud.ibsnet.co.jp/
 */
interface AddressRepository
{

    /**
     * 郵便番号を元に住所を検索します。
     *
     * @return array
     */
    public function search(string $postalCode): array;
}
