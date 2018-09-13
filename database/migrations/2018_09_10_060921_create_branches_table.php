<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('description');
            $table->text('about');
            $table->string('phone', 12);
            $table->string('address', 150);
            $table->string('website', 50);
            $table->string('email', 30)->unique();
            $table->string('facebook', 50);
            $table->string('instagram', 50);
            $table->string('zalo', 50);
            $table->string('tax_number', 20);
            $table->string('bank', 100);
            $table->boolean('type')->default(0);
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('district_id')->index();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('branches');
    }
}
