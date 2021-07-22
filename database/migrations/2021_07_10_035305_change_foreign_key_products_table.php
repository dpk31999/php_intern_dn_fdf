<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignKeyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggest_products', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->foreignId('cate_id')->constrained('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggest_products', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products');
            $table->dropForeign(['cate_id']);
            $table->dropColumn('cate_id');
        });
    }
}
