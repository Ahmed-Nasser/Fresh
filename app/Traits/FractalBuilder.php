<?php


namespace App\Traits;


use App\Http\Resources\ArraySerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\TransformerAbstract;
use Spatie\Fractal\Facades\Fractal;
use Spatie\Fractalistic\Fractal as BaseFractal;

trait FractalBuilder
{
    /**
     * Create base fractal collection instance.
     * @param  mixed              $collection
     * @param  TransformerAbstract $transformer
     * @param  array               $includes
     * @return BaseFractal
     */
    private function fractalCollectionBuilder($collection, TransformerAbstract $transformer, array $includes = []): BaseFractal
    {
        return Fractal::create()
            ->collection($collection, $transformer)
            ->serializeWith(new ArraySerializer())
            ->parseIncludes($includes);
    }

    /**
     * Transform fractal collection.
     * @param  mixed              $collection
     * @param  TransformerAbstract $tranformer
     * @param  array               $includes
     * @return array
     */
    public function fractalCollection($collection, TransformerAbstract $tranformer, array $includes = []): array
    {
        return $this->fractalCollectionBuilder($collection, $tranformer, $includes)->toArray();
    }

    /**
     * Transform fractal collection paginated.
     * @param  mixed              $collection
     * @param  TransformerAbstract $tranformer
     * @param  array               $includes
     * @return array
     */
    public function fractalCollectionPaginated($collection, TransformerAbstract $transformer, array $includes = []): array
    {
        return $this->fractalCollectionBuilder($collection, $transformer, $includes)
            ->paginateWith(new IlluminatePaginatorAdapter($collection))
            ->toArray();
    }

    /**
     * Transform fractal item.
     * @param  mixed              $collection
     * @param  TransformerAbstract $tranformer
     * @param  array               $includes
     * @return array
     */
    public function fractalItem($collection, TransformerAbstract $tranformer, array $includes = []): array
    {
        return Fractal::create()
            ->item($collection, $tranformer)
            ->serializeWith(new ArraySerializer())
            ->parseIncludes($includes)
            ->toArray();
    }

}
