<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LECTURER', function (Blueprint $table) {
            $table->unsignedBigInteger('LECTURER_ID')->autoIncrement();
            $table->string('FIRST_NAME',100)->nullable(false);
            $table->string('LAST_NAME',100)->nullable(false);
            $table->unsignedBigInteger('USER_ID');
            $table->foreign('USER_ID')->references('USER_ID')->on('USER');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LECTURER');
    }
}
