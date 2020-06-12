<?php

namespace App\Http\Controllers\App\Api\My;

use App\Http\Controllers\Controller;
use App\Models\Interfaces\PaginateModel;
use App\Models\UserActivity;
use App\UseCases\PaginationUseCase;
use App\Requests\Interfaces\PaginationInput;
use App\Transformers\UserActivity\Transformer as ActivityTransformer;
use Auth;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            app()->bind(PaginateModel::class, UserActivity::class);
            return $next($request);
        });
    }

    public function __invoke(PaginationUseCase $usecase, Responder $responder): JsonResponse
    {
        return $responder
            ->success($usecase([ 'user_id' => Auth::id() ]), ActivityTransformer::class)
            ->respond()
        ;
    }
}
