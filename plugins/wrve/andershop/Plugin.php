<?php namespace WRvE\AnderShop;

use App;
use Backend\Models\BrandSetting;
use Event;
use Mockery\Exception;
use System\Classes\PluginBase;
use Wrve\Andershop\Components\Products;
use WRvE\AnderShop\Models\Product;
use WRvE\AnderShop\Components\Product as ProductComponent;
use WRvE\AnderShop\Models\Variant;

class Plugin extends PluginBase
{
    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        throw new Exception('Sentry test');

        App::before(function () {
            // Share the variables with the CMS template system
            Event::listen('cms.page.beforeDisplay', function ($controller, $url, $page) {
                $controller->vars['app_name'] = BrandSetting::get('app_name');
            });
        });
    }

    public function registerComponents()
    {
        return [
            ProductComponent::class => 'product',
            Products::class => 'products',
        ];
    }
}
