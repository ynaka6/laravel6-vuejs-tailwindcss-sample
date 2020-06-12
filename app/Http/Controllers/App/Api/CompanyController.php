<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\Controller;
use App\Models\Interfaces\PaginateModel;
use App\Models\Company;
use App\Requests\Interfaces\PaginationInput;
use App\UseCases\PaginationUseCase;
use App\Http\Requests\App\Company\PaginationRequest;
use App\Transformers\Company\Transformer as CompanyTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            app()->bind(PaginateModel::class, Company::class);
            app()->bind(PaginationInput::class, PaginationRequest::class);
            return $next($request);
        })->only('index');
    }

    public function index(PaginationInput $request, PaginationUseCase $usecase, Responder $responder): JsonResponse
    {
        return $responder
            ->success($usecase($request->all()), CompanyTransformer::class)
            ->respond()
        ;
    }
}
