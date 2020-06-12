<?php

namespace App\UseCases;

use App\Models\Interfaces\CreateModel;

class CreateUseCase
{
    private $model;

    public function __construct(CreateModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(array $attribute = []): void
    {
        $this->model->create($attribute);
    }
}
