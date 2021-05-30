<?php namespace WRvE\AnderShop\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddStockToVariants extends Migration
{
    public function up()
    {
        Schema::table('wrve_andershop_product_variants', function ($table) {
            $table->integer('stock')->default(0);
        });
    }

    public function down()
    {
        Schema::table('wrve_andershop_product_variants', function ($table) {
            $table->dropColumn('stock');
        });
    }
}
