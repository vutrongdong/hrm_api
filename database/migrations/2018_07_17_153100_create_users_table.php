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
            $table->mediumInteger('code')->unsigned();
            $table->string('name');
            $table->string('qualification', 20)->nullable();
            $table->string('address', 150);
            $table->string('phone', 12)->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->date('date_of_birth')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status')->default(0);
            
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
