<?php namespace WRvE\AnderShop;

use App;
use Backend\Models\BrandSetting;
use Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        App::before(function () {
            // Share the variables with the CMS template system
            Event::listen('cms.page.beforeDisplay', function ($controller, $url, $page) {
                $controller->vars['app_name'] = BrandSetting::get('app_name');
            });
        });
    }
}
