<?php

namespace App\Transformers\Company;

use App\Models\Company;
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
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Company $company
     * @return array
     */
    public function transform(Company $company): array
    {
        return [
            'id'            => (int) $company->id,
            'name'          => (string) $company->name,
            'nameKana'      => $company->name_kana,
            'ceo'           => $company->ceo,
            'founded'       => $company->founded,
            'url'           => $company->url,
            'email'         => $company->email,
            'tel'           => $company->tel,
            'fax'           => $company->fax,
            'postalCode'    => $company->postal_code,
            'address'       => $company->address,
            'plan' => [
                'slug' => optional($company->plan)->slug,
                'name' => optional($company->plan)->name,
            ],
        ];
    }
}
