<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Interfaces\UpdateModel;
use App\UseCases\UpdateUseCase;
use App\Requests\Interfaces\UpdateInput;
use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

/**
 * 更新用の共通コントローラー
 */
class UpdateController extends Controller
{
    private $modelName;

    public function __construct()
    {
        // Middlewareにて、Model名称を推測しbindする
        $this->middleware(function (Request $request, $next) {
            $this->modelName = ucfirst(explode('.', $request->route()->getName())[0]);
            
            // Modelのバインド設定
            $modelClass = 'App\\Models\\' . $this->modelName;
            if (!class_exists($modelClass)) {
                throw new \Exception('Model Not Found');
            }
            app()->bind(UpdateModel::class, $modelClass);

            // FormRequestのバインド設定
            $formRequestClass = 'App\\Http\\Requests\\Admin\\' . $this->modelName . '\\UpdateRequest';
            if (!class_exists($formRequestClass)) {
                throw new \Exception('FormRequest Not Found');
            }
            app()->bind(UpdateInput::class, $formRequestClass);

            return $next($request);
        });
    }

    /**
     * 登録処理を実行します
     */
    public function __invoke(UpdateInput $request, UpdateUseCase $usecase, Responder $responder): JsonResponse
    {
        $usecase($request->id(), $request->validated());
        return $responder
            ->success()
            ->respond()
        ;
    }
}
