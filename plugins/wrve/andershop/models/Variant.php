<?php namespace WRvE\AnderShop\Models;

use Model;
use Winter\Storm\Database\Traits\SoftDelete;
use Winter\Storm\Database\Traits\Validation;

class Variant extends Model
{
    use Validation;
    use SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'wrve_andershop_product_variants';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => ['required', 'max:191'],
    ];
}
