<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Interfaces\DeleteModel;
use App\UseCases\DeleteUseCase;
use App\Requests\Interfaces\DeleteInput;
use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

/**
 * 削除用の共通コントローラー
 */
class DeleteController extends Controller
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
            app()->bind(DeleteModel::class, $modelClass);

            // FormRequestのバインド設定
            $formRequestClass = 'App\\Http\\Requests\\Admin\\' . $this->modelName . '\\DeleteRequest';
            if (!class_exists($formRequestClass)) {
                throw new \Exception('FormRequest Not Found');
            }
            app()->bind(DeleteInput::class, $formRequestClass);

            return $next($request);
        });
    }

    /**
     * 削除処理を実行します
     */
    public function __invoke(DeleteInput $request, DeleteUseCase $usecase, Responder $responder): JsonResponse
    {
        $usecase([
            'id' => $request->id()
        ]);
        return $responder
            ->success()
            ->respond()
        ;
    }
}
