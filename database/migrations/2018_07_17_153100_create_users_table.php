<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name');
            $table->string('qualification', 20)->nullable();
            $table->string('address', 150);
            $table->string('phone', 12);
            $table->tinyInteger('gender')->default(0); //female
            $table->date('date_of_birth');
            $table->string('avatar');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
