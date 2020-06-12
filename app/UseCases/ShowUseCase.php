<?php

namespace App\UseCases;

use App\Models\Interfaces\ShowModel;

class ShowUseCase
{
    private $model;

    public function __construct(ShowModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(array $confition)
    {
        return $this->model->firstByCondition($confition);
    }
}
