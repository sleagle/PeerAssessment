<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('STUDENT_TOPIC', function (Blueprint $table) {
            $table->unsignedBigInteger('TOPIC_ID');
            $table->unsignedBigInteger('STUDENT_ID');
            $table->primary(['TOPIC_ID','STUDENT_ID']);
            $table->foreign('TOPIC_ID')->references('TOPIC_ID')->on('TOPIC');
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
        Schema::dropIfExists('STUDENT_TOPIC');
    }
}
