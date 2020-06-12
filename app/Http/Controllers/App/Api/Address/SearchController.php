<?php

namespace App\Http\Controllers\App\Api\Address;

use App\Http\Controllers\Controller;
use App\UseCases\SearchAddressUseCase;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Auth;

class SearchController extends Controller
{
    public function __invoke(Request $request, SearchAddressUseCase $usecase, Responder $responder): JsonResponse
    {
        return $responder
            ->success($request->code ? $usecase($request->code) : null)
            ->respond()
        ;
    }
}
