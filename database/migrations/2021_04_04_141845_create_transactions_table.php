<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("product_id")->unsigned();
            $table->integer("imported_container")->default(0);
            $table->integer("expected_container")->default(0);
            $table->integer("expected_package")->default(0);
            $table->integer("expected_unit")->default(0);
            $table->bigInteger("store_imports_id")->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('store_imports_id')->references('id')->on('store_imports')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
