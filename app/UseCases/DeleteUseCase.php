<?php

namespace App\UseCases;

use App\Models\Interfaces\DeleteModel;

class DeleteUseCase
{
    private $model;

    public function __construct(DeleteModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(array $confition): void
    {
        $this->model->deleteByCondition($confition);
    }
}
