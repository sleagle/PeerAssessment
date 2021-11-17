<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('STUDENT', function (Blueprint $table) {
            $table->unsignedBigInteger('STUDENT_ID')->autoIncrement();
            $table->string('FIRST_NAME', 100)->nullable(false);
            $table->string('LAST_NAME', 100)->nullable(false);
            $table->boolean('IS_ENABLED')->nullable(false);
            $table->unsignedBigInteger('USER_ID')->nullable(false);
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
        Schema::dropIfExists('STUDENT');
    }
}
