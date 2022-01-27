<?php namespace Wrve\Andershop\Components;

use Cms\Classes\ComponentBase;
use Winter\Storm\Database\Builder;
use WRvE\AnderShop\Models\Product as ProductModel;

class Products extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Products Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function getProducts()
    {
        return ProductModel::query()
            ->orderBy('name')
            ->whereHas('variants', function (Builder $query) {
                $query->where('stock', '>', 0);
            })->get();
    }
}
