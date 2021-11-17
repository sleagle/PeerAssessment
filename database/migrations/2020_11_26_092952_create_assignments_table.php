<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ASSIGNMENT', function (Blueprint $table) {
            $table->id('ASSIGNMENT_ID');
            $table->integer('YEAR')->nullable(false);
            $table->string('SEMESTER', 10)->nullable(false);
            $table->string('TITLE',100)->nullable(false);
            $table->string('OUTCOME',200)->nullable(false);
            $table->string('SCENARIO',250)->nullable(false);
            $table->dateTime('TOPIC_SELECTION_DEADLINE')->nullable(false);
            $table->dateTime('ASSIGNMENT_SUBMISSION_DEADLINE')->nullable(false);
            $table->dateTime('ASSIGNMENT_SUBMISSION_CLOSING')->nullable(false);
            $table->dateTime('ASSIGNMENT_MARKING_OPENING_DATE')->nullable(false);
            $table->dateTime('ASSIGNMENT_MARKING_DEADLINE')->nullable(false);
            $table->dateTime('FEEDBACK_MARKING_OPENING_DATE')->nullable(false);
            $table->dateTime('FEEDBACK_MARKING_DEADLINE')->nullable(false);
            $table->integer('NO_OF_REVIEWS')->nullable(false);
            $table->string('ALLOCATION_CRITERIA', 50)->nullable(false);
            $table->string('UNIT_CODE',6)->nullable(false);
            $table->foreign('UNIT_CODE')->references('UNIT_CODE')->on('UNIT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ASSIGNMENT');
    }
}
