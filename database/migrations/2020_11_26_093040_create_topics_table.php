<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TOPIC', function (Blueprint $table) {
            $table->id('TOPIC_ID');
            $table->string('TOPIC_NAME', 100)->nullable(false);
            $table->integer('NUM_OF_STUDENTS')->nullable(false);
            $table->integer('NUM_SELECTED')->nullable(false);
            $table->unsignedBigInteger('ASSIGNMENT_ID')->nullable(false);
            $table->foreign('ASSIGNMENT_ID')->references('ASSIGNMENT_ID')->on('ASSIGNMENT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TOPIC');
    }
}
