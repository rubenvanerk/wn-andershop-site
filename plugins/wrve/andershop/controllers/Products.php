<?php namespace WRvE\AnderShop\Controllers;

use Backend\Behaviors\RelationController;
use Backend\Classes\Controller;
use BackendMenu;
use Backend\Behaviors\ListController;
use Backend\Behaviors\FormController;

class Products extends Controller
{
    public $implement = [
        ListController::class,
        FormController::class,
        RelationController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['wrve.andershop.access_products'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('WRvE.AnderShop', 'products');
    }

    public function listInjectRowClass($product, $definition = null)
    {
        if (!$product->published_at || $product->published_at > now()) {
            return 'disabled';
        }
    }
}
