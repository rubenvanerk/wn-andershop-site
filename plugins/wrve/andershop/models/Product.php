<?php namespace WRvE\AnderShop\Models;

use Model;
use Winter\Storm\Database\Traits\SoftDelete;
use Winter\Storm\Database\Traits\Validation;

class Product extends Model
{
    use Validation;
    use SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'wrve_andershop_products';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => ['required', 'max:191'],
        'slug' => ['required', 'max:191', 'unique:wrve_andershop_products', 'alpha_dash'],
    ];
}
