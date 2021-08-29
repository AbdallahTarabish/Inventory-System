<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_store_id');
            $table->string('name');
            $table->text('location_url');
            $table->integer('status')->default(1);
            $table->foreign('main_store_id')->references('id')->on('main_stores')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_stores');
    }
}
