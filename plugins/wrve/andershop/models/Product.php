<?php namespace WRvE\AnderShop\Models;

use BackendAuth;
use Model;
use System\Models\File;
use Winter\Storm\Database\Builder;
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

    protected static function boot()
    {
        parent::boot();

        if (!BackendAuth::check()) {
            static::addGlobalScope('published', function (Builder $builder) {
                $builder->where('published', true);
            });
        }
    }

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => ['required', 'max:191'],
        'slug' => ['required', 'max:191', 'unique:wrve_andershop_products', 'alpha_dash'],
        'description' => ['nullable', 'max:65535'],
    ];

    public $attachMany = ['images' => [File::class]];

    public $hasMany = ['variants' => Variant::class];
}
