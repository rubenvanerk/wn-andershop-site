<?php namespace WRvE\AnderShop\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateWrveAndershopProducts extends Migration
{
    public function up()
    {
        Schema::create('wrve_andershop_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wrve_andershop_products');
    }
}
