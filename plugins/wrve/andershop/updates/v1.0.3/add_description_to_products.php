<?php namespace WRvE\AnderShop\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateWrveAndershopProducts extends Migration
{
    public function up()
    {
        Schema::table('wrve_andershop_products', function($table)
        {
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('wrve_andershop_products', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
