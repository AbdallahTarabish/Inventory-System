<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger("main_store_id")->nullable();
            $table->unsignedBigInteger("store_id")->nullable();
            $table->foreign('main_store_id')->references('id')->on('main_stores')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('sub_stores')->onDelete('cascade');
            $table->boolean('isFilled')->default(-1);
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
        Schema::dropIfExists('sectors');
    }
}
