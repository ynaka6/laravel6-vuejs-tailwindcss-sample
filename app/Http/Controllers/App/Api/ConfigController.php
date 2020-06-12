<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\Controller;
use App\UseCases\App\GetConfigUseCase;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

/**
 * 設定・定数情報を返却します
 */
class ConfigController extends Controller
{
    /**
     * 設定・定数情報を取得
     */
    public function __invoke(GetConfigUseCase $usecase, Responder $responder): JsonResponse
    {
        return $responder
            ->success($usecase())
            ->respond()
        ;
    }
}
