<?php

namespace App\UseCases;

use App\Models\Interfaces\PaginateModel;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationUseCase
{
    private $model;

    public function __construct(PaginateModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(array $attribute = []): LengthAwarePaginator
    {
        return $this->model->paginateByCondition($attribute);
    }
}
