<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("product_id")->unsigned();
            $table->integer("actual_container")->default(0);
            $table->integer("packages_count")->default(0);
            $table->integer("units_count")->default(0);
            $table->integer("expected_container")->default(0);
            $table->integer("expected_package")->default(0);
            $table->integer("expected_unit")->default(0);
            $table->bigInteger("store_id")->unsigned()->nullable();
            $table->bigInteger("main_store_id")->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('sub_stores')->onDelete('cascade');
            $table->foreign('main_store_id')->references('id')->on('main_stores')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_products');
    }
}
