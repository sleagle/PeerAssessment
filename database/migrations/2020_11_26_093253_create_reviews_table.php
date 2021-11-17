<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REVIEW', function (Blueprint $table) {
            $table->id('REVIEW_ID');
            $table->unsignedBigInteger('SUBMISSION_ID')->nullable(false);
            $table->unsignedBigInteger('REVIEWER_ID')->nullable(false);
            $table->boolean('IS_COMPLETE')->nullable(false);
            $table->integer('FEEDBACK_MARK')->nullable(false);
            $table->string('FEEDBACK_COMMENTS',250)->nullable(false);
            $table->foreign('SUBMISSION_ID')->references('SUBMISSION_ID')->on('SUBMISSION');
            $table->foreign('REVIEWER_ID')->references('STUDENT_ID')->on('STUDENT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('REVIEW');
    }
}
