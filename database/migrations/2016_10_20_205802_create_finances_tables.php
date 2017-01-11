<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->string('title');
            $table->text('description')->nullable();
            $table->float('amount', 20, 2);
            $table->string('type');
            $table->string('reason');
            $table->dateTime('executed_at');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finances');
    }
}
