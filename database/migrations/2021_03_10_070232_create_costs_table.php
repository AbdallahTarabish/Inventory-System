<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->double("cost_of_one_container");
            $table->double("price_of_one_container");
            $table->double("cost_of_one_package")->nullable();
            $table->double("price_of_one_package")->nullable();
            $table->double("cost_of_one_unit")->nullable();
            $table->double("price_of_one_unit")->nullable();
            $table->string("container_barcode")->unique();
            $table->string("package_barcode")->unique()->nullable();
            $table->string("unit_barcode")->unique()->nullable();
            $table->bigInteger("product_id")->unsigned();
            $table->timestamps();
            $table->foreign("product_id")->on("products")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costs');
    }
}
