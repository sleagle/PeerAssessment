<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ENROLLED_IN', function (Blueprint $table) {
            $table->string('UNIT_CODE',6);
            $table->unsignedBigInteger('STUDENT_ID');
            $table->integer('YEAR');
            $table->integer('SEMESTER');
            $table->primary(['UNIT_CODE','STUDENT_ID']);
            $table->foreign('UNIT_CODE')->references('UNIT_CODE')->on('UNIT');
            $table->foreign('STUDENT_ID')->references('STUDENT_ID')->on('STUDENT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ENROLLED_IN');
    }
}
