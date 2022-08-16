<?php


namespace App\Repository;


use App\Contracts\ProductInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductInterface
{
    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Product[]|Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }


}
