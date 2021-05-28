<?php

use WRvE\AnderShop\Models\Product;
use WRvE\AnderShop\Models\Variant;

/** @var $factory Illuminate\Database\Eloquent\Factory */
$factory->define(Product::class, function (\OFFLINE\Seeder\Classes\Generator $faker) {
    $name = $faker->words(random_int(1, 3), true);
    return [
        'name' => ucfirst($name),
        'slug' => str_slug($name),
        'description' => $faker->text,
    ];
});

/** @var $factory Illuminate\Database\Eloquent\Factory */
$factory->define(Variant::class, function (\OFFLINE\Seeder\Classes\Generator $faker) {
    return [
        'name' => ucfirst($faker->words(random_int(1, 3), true)),
        'product_id' => 0,
    ];
});
