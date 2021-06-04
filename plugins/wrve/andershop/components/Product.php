<?php namespace WRvE\AnderShop\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use Input;
use WRvE\AjaxPopup\Components\AjaxPopup;
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

    public function init()
    {
        $this->addComponent(AjaxPopup::class, 'ajaxPopup', []);
    }

    public function onRun()
    {

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
            '#product-images-' . $product->id => $this->renderPartial('@product-images', [
                'item' => $product,
                'activeImage' => $activeImage,
            ]),
        ];
    }

    public function onShowRequestForm(): array
    {
        $product = $this->getProduct();
        return [
            'requestForm' => $this->renderPartial('@request-form', [
                'item' => $product,
            ]),
        ];
    }

    public function getProduct()
    {
        $this->product = ProductModel::where('slug', $this->property('slug'))->first();
        if (Input::get('variant_id')) {
            $this->variant = $this->product->variants()->find(Input::get('variant_id'));
        }
        return $this->variant ?? $this->product;
    }
}
