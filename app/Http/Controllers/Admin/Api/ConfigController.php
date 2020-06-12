<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use App\Enums\Models\Admin\Role;

/**
 * 設定・定数情報を返却します
 */
class ConfigController extends Controller
{
    /**
     * 設定・定数情報を取得
     */
    public function __invoke(Responder $responder): JsonResponse
    {
        return $responder
            ->success([
                'adminRoles' => Role::toSelectArray()
            ])
            ->respond()
        ;
    }
}
