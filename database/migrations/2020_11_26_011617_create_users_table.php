<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('USER', function (Blueprint $table) {
            $table->id('USER_ID');
            $table->string('USERNAME',10)->nullable(false)->unique();
            $table->string('PASSWORD', 100)->nullable(false);
            $table->unsignedBigInteger('USER_TYPE_ID');
            $table->foreign('USER_TYPE_ID')->references('USER_TYPE_ID')->on('USER_TYPE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('USER');
    }
}
