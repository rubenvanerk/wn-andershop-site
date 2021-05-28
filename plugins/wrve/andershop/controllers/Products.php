<?php namespace WRvE\AnderShop\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Products extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'wrve.andershop.access_products' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('WRvE.AnderShop', 'products');
    }
}
