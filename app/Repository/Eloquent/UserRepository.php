<?php


namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $parameters
     * @return Collection
     */
    public function all(array $parameters): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $parameters
     * @return LengthAwarePaginator
     */
    public function list(array $parameters): LengthAwarePaginator
    {
        return $this->model->paginate($parameters['perPage'] ?? 5);
    }
}
