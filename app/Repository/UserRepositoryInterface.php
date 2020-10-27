<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function all(array $parameters): Collection;

    public function list(array $parameters): LengthAwarePaginator;
}
