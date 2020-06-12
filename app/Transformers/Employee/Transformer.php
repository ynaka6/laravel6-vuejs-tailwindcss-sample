<?php

namespace App\Transformers\Employee;

use App\Models\Employee;
use App\Transformers\Company\Transformer as CompanyTransformer;
use Flugg\Responder\Transformers\Transformer as AbstructTransformer;

class Transformer extends AbstructTransformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [
        'company' => CompanyTransformer::class
    ];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Employee $employee
     * @return array
     */
    public function transform(Employee $employee): array
    {
        return [
            'id'            => (int) $employee->id,
            'department'    => (string) $employee->department,
            'position'      => (string) $employee->position,
            'tel'           => (string) $employee->tel,
            'status'        => (int) $employee->status,
            'role'          => (int) $employee->role,
        ];
    }
}
