<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_place', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_product_id')->constrained('store_products');
            $table->foreignId('sector_id')->constrained('sectors');
            $table->foreignId('sub_sector_id')->nullable()->constrained('sub_sectors');
            $table->foreignId('shelf_id')->nullable()->constrained('shelves');
            $table->integer('containers');
            $table->integer('packages');
            $table->integer('units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_place');
    }
}
