<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CRITERIA_REVIEW', function (Blueprint $table) {
            $table->unsignedBigInteger('CRITERIA_ID');
            $table->unsignedBigInteger('REVIEW_ID');
            $table->integer('MARK')->nullable(false);
	        $table->string('COMMENT',250)->nullable(false);
            $table->string('GRADE',2)->nullable(false);
            $table->primary(['CRITERIA_ID','REVIEW_ID']);
            $table->foreign('CRITERIA_ID')->references('CRITERIA_ID')->on('CRITERIA');
            $table->foreign('REVIEW_ID')->references('REVIEW_ID')->on('REVIEW');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CRITERIA_REVIEW');
    }
}
