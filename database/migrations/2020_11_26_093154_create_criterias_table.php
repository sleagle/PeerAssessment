<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CRITERIA', function (Blueprint $table) {
            $table->id('CRITERIA_ID');
            $table->string('CRITERIA_NAME',100)->nullable(false);
            $table->integer('CRITERIA_MARKS')->nullable(false);
            $table->string('HD_CRITERIA_DESC',250)->nullable(false);
            $table->string('DN_CRITERIA_DESC',250)->nullable(false);
            $table->string('CR_CRITERIA_DESC',250)->nullable(false);
            $table->string('PP_CRITERIA_DESC',250)->nullable(false);
            $table->string('NN_CRITERIA_DESC',250)->nullable(false);
            $table->unsignedBigInteger('ASSIGNMENT_ID')->nullable(false);
            $table->boolean('CONTAIN_SUB_CATEGORY')->nullable(false);
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
        Schema::dropIfExists('CRITERIA');
    }
}
