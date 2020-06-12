<?php

namespace App\Repositories\Zipcloud;

use App\Repositories\Interfaces\Zipcloud\AddressRepository as AddressRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddressRepository implements AddressRepositoryInterface
{
    private const ZIPCLOUD_API_URL = 'http://zipcloud.ibsnet.co.jp/api/search';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * 郵便番号を元に住所を検索します。
     *
     * @return array
     */
    public function search(string $postalCode): array
    {
        $response = $this->client->get(self::ZIPCLOUD_API_URL, [
            'query' => ['zipcode' => $postalCode]
        ]);

        if ($response->getStatusCode() === Response::HTTP_OK) {
            $body = $response->getBody();
            $json = json_decode($body->getContents(), true);

            if ($json['status'] === Response::HTTP_NOT_FOUND) {
                throw new NotFoundHttpException();
            } elseif ($json['status'] === Response::HTTP_BAD_REQUEST) {
                throw new \Exception($json['message']);
            }
            return $json['results'];
        }
        throw new \Exception();
    }
}
