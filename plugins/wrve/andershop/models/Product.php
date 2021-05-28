<?php namespace WRvE\AnderShop\Models;

use Model;
use System\Models\File;
use Winter\Storm\Database\Traits\SoftDelete;
use Winter\Storm\Database\Traits\Validation;

class Product extends Model
{
    use Validation;
    use SoftDelete;

    protected $dates = ['deleted_at', 'published_at'];

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
        'description' => ['nullable', 'max:65535'],
    ];

    public $attachMany = ['images' => [File::class, 'public' => false]];

    public $hasMany = ['variants' => Variant::class];

    public function filterFields($fields, $context)
    {
        if ($this->published_at) {
            $fields->_published->value = true;
        } else {
            $fields->published_at->value = now();
        }
    }
}
