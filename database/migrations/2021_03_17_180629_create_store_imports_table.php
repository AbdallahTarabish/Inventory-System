<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_imports', function (Blueprint $table) {
            $table->id();
            $table->string("import_code");
            $table->dateTime("time");
            $table->bigInteger("main_store_id")->unsigned()->nullable();
            $table->bigInteger("store_id")->unsigned()->nullable();
            $table->bigInteger("user_id")->unsigned();
            $table->tinyInteger("type");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('main_store_id')->references('id')->on('main_stores')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('sub_stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_imports');
    }
}
