<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Interfaces\PaginateModel;
use App\UseCases\PaginationUseCase;
use App\Requests\Interfaces\PaginationInput;
use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use Auth;

/**
 * ページング用の共通コントローラー
 */
class PaginationController extends Controller
{
    private $modelName;

    public function __construct()
    {
        // Middlewareにて、Model名称を推測しbindする
        $this->middleware(function (Request $request, $next) {
            $this->modelName = ucfirst(explode('.', $request->route()->getName())[0]);
            $modelClass = 'App\\Models\\' . $this->modelName;
            if (!class_exists($modelClass)) {
                throw new \Exception('Model Not Found');
            }
            app()->bind(PaginateModel::class, $modelClass);

            $formRequestClass = 'App\\Http\\Requests\\Admin\\' . $this->modelName . '\\PaginationRequest';
            if (!class_exists($formRequestClass)) {
                $formRequestClass = Request::class;
            }
            app()->bind(PaginationInput::class, $formRequestClass);

            return $next($request);
        });
    }

    /**
     * ページングのデータを取得
     */
    public function __invoke(PaginationInput $request, PaginationUseCase $usecase, Responder $responder): JsonResponse
    {
        $transformer = 'App\\Transformers\\' . $this->modelName . 'Transformer';
        if (!class_exists($transformer)) {
            $transformer = null;
        }
        return $responder
            ->success($usecase($request->all()), $transformer)
            ->respond()
        ;
    }
}
