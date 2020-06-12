<?php

namespace App\UseCases;

use App\Models\Interfaces\UpdateModel;

class UpdateUseCase
{
    private $model;

    public function __construct(UpdateModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(int $id, array $attribute = []): void
    {
        $this->model->updateOrCreate([ 'id' => $id ], $attribute);
    }
}
