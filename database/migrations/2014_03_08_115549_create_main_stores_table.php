<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('location_url');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

        });

        \Illuminate\Support\Facades\DB::table("main_stores")->insert([
            "name"=>"المخزن الرئيسي" ,
            "location_url" => "فلسطين- غزة- شارع عمر المختار",
            "status" => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_stores');
    }
}
