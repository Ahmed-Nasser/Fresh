<?php


namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repository\EloquentRepositoryInterface;

class BaseRepository implements EloquentRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $attributes, string $id): int
    {
        $model = $this->model->find($id);
        if (!$model){
            return 0;
        }

        return $model->update($attributes, ['upsert' => true]);
    }
}
