<?php namespace WRvE\AnderShop\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateWrveAndershopProductVariants extends Migration
{
    public function up()
    {
        Schema::create('wrve_andershop_product_variants', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
              ->references('id')->on('wrve_andershop_products')
              ->onDelete('cascade');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wrve_andershop_product_variants');
    }
}
