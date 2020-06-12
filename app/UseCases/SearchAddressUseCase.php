<?php

namespace App\UseCases;

use App\Repositories\Interfaces\Zipcloud\AddressRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchAddressUseCase
{
    private $repository;

    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $search): ?array
    {
        return $this->repository->search($search);
    }
}
