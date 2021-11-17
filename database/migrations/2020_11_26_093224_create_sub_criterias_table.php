<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SUB_CRITERIA', function (Blueprint $table) {
            $table->id('SUB_CRITERIA_ID');
            $table->string('SUB_CRITERIA_TYPE',3)->nullable(false);
            $table->string('SUB_CRITERIA_DESC',250)->nullable(false);
            $table->string('SUB_CRITERIA_MARKS',20)->nullable(false);
            $table->unsignedBigInteger('CRITERIA_ID')->nullable(false);
            $table->foreign('CRITERIA_ID')->references('CRITERIA_ID')->on('CRITERIA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SUB_CRITERIA');
    }
}
