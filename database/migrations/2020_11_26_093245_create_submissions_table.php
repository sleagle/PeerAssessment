<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SUBMISSION', function (Blueprint $table) {
            $table->id('SUBMISSION_ID');
            $table->unsignedBigInteger('STUDENT_ID')->nullable(false);
            $table->unsignedBigInteger('ASSIGNMENT_ID')->nullable(false);
            $table->dateTime('SUBMISSION_DATE')->nullable(false);
            $table->string('FILE',100)->nullable(false);
            $table->integer('NUM_REVIEWS')->nullable(false);
            $table->foreign('STUDENT_ID')->references('STUDENT_ID')->on('STUDENT');
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
        Schema::dropIfExists('SUBMISSION');
    }
}
