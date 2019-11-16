<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('question_id');
            $table->integerIncrements('order');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('survey_id')->references('id')->on('surveys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_orders');
    }
}
