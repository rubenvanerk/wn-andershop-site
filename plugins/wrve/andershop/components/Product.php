<?php namespace WRvE\AnderShop\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use Input;
use Session;
use WRvE\AnderShop\Models\Product as ProductModel;
use WRvE\AnderShop\Models\Variant;

class Product extends ComponentBase
{
    protected ?ProductModel $product;
    protected ?Variant $variant;

    public function componentDetails()
    {
        return [
            'name' => 'Product Component',
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

    public function __construct(CodeBase $cmsObject = null, $properties = [])
    {
        parent::__construct($cmsObject, $properties);
    }

    public function onRun()
    {
        Session::forget('variant');

        $this->page['product'] = $this->getProduct();

        if (!$this->product) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        $this->page->title = $this->product->name;
    }

    public function onSelectImage(): array
    {
        $product = $this->getProduct();
        $activeImage = $product->images()->find(Input::get('image_id'));
        return [
            '#product-images' => $this->renderPartial('@product-images', [
                'item' => $product,
                'activeImage' => $activeImage,
            ]),
        ];
    }

    public function onSelectVariant(): array
    {
        $this->getProduct();
        $variant = $this->product->variants()->find(Input::get('variant_id'));
        Session::put('variant', $variant ? $variant->id : null);
        return [
            '#product-images' => $this->renderPartial('@product-images', ['item' => $variant ?? $this->product]),
        ];
    }

    public function getProduct()
    {
        $this->product = ProductModel::where('slug', $this->property('slug'))->first();
        if (Session::get('variant')) {
            $this->variant = $this->product->variants()->find(Session::get('variant'));
        }
        return $this->variant ?? $this->product;
    }
}
