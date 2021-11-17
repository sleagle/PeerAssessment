<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UNIT', function (Blueprint $table) {
            $table->string('UNIT_CODE', 6)->primary();
            $table->string('UNIT_NAME',100)->nullable(false);
            $table->unsignedBigInteger('LECTURER_ID');
            $table->foreign('LECTURER_ID')->references('LECTURER_ID')->on('LECTURER');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UNIT');
    }
}
