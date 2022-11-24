<?php namespace WRvE\AnderShop\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableUpdateWrveAndershopProductsPublishedAtToPublished extends Migration
{
    public function up()
    {
        Schema::table('wrve_andershop_products', function (Blueprint $table) {
            $table->boolean('published')->default(0);
            $table->dropColumn('published_at');
        });
    }

    public function down()
    {
        Schema::table('wrve_andershop_products', function ($table) {
            $table->dropColumn('published');
            $table->timestamp('published_at')->nullable();
        });
    }
}
