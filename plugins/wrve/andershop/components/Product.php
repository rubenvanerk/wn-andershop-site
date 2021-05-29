<?php namespace WRvE\AnderShop\Components;

use Cms\Classes\ComponentBase;
use WRvE\AnderShop\Models\Product as ProductModel;

class Product extends ComponentBase
{
    protected ?ProductModel $product;

    public function componentDetails()
    {
        return [
            'name'        => 'Product Component',
            'description' => 'Component to show products',
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'Product slug',
                'default' => '{{ :slug }}',
                'type' => 'string',
            ],
        ];
    }

    public function onRun()
    {
        $this->page['product'] = $this->product = ProductModel::where('slug', $this->property('slug'))->first();

        if (!$this->product) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        $this->page->title = $this->product->name;
    }
}
