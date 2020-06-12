<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Interfaces\ShowModel;
use App\UseCases\ShowUseCase;
use App\Requests\Interfaces\ShowInput;
use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

/**
 * 参照用の共通コントローラー
 */
class ShowController extends Controller
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
            app()->bind(ShowModel::class, $modelClass);

            // FormRequestのバインド設定
            $formRequestClass = 'App\\Http\\Requests\\Admin\\' . $this->modelName . '\\ShowRequest';
            if (!class_exists($formRequestClass)) {
                throw new \Exception('FormRequest Not Found');
            }
            app()->bind(ShowInput::class, $formRequestClass);

                        
            return $next($request);
        });
    }

    /**
     * 取得処理を実行します
     */
    public function __invoke(ShowInput $request, ShowUseCase $usecase, Responder $responder): JsonResponse
    {
        $transformer = 'App\\Transformers\\' . $this->modelName . 'Transformer';
        if (!class_exists($transformer)) {
            $transformer = null;
        }
        return $responder
            ->success($usecase([
                'id' => $request->id()
            ]), $transformer)
            ->respond()
        ;
    }
}
