<?php namespace WRvE\AnderShop\Components;

use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use Flash;
use Input;
use Mail;
use Session;
use ValidationException;
use Validator;
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
                'name' => Session::get('name'),
                'email' => Session::get('email'),
                'phone_number' => Session::get('phone_number'),
            ]),
        ];
    }

    public function onRequest()
    {
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
            'amount' => ['required', 'min:1', 'integer'],
        ];

        $validator = Validator::make(post(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();
        $data['variant'] = Variant::findOrFail(post('variant_id'));

        Session::put('name', $data['name']);
        Session::put('email', $data['email']);
        Session::put('phone_number', $data['phone_number']);

        Mail::sendTo(
            ['drechtsteden@stichtinganders.nl' => 'Stichting Anders Drechtsteden'],
            'wrve.andershop::mail.request',
            $data,
            function ($message) use ($data) {
                $message->replyTo($data['email'], $data['name']);
            }
        );

        Flash::success('We hebben je aanvraag succesvol ontvangen. We nemen zo spoedig mogelijk contact met je op.');
    }

    public function getProduct()
    {
        $this->product = ProductModel::where('slug', $this->property('slug'))
            ->with(['variants' => function ($query) {
                $query->orderBy('name')->with('images');
            }])
            ->first();
        if (Input::get('variant_id')) {
            $this->variant = $this->product->variants()->find(Input::get('variant_id'));
        }
        return $this->variant ?? $this->product;
    }

    public function getVariants()
    {
        return $this->product->variants()->where('stock', '>', 0)->get();
    }
}
