<?php namespace WRvE\AnderShop\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class AddPublishedToProducts extends Migration
{
    public function up()
    {
        Schema::table('wrve_andershop_products', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('wrve_andershop_products', function ($table) {
            $table->dropColumn('published_at');
        });
    }
}
