<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('wards', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name', 30);
        //     $table->string('slug', 35);
        //     $table->unsignedMediumInteger('zipcode');
        //     $table->unsignedTinyInteger('order');
        //     $table->boolean('status')->default(1);

        //     $table->unsignedInteger('district_id');
        //     $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wards');
    }
}
