<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned()->nullable();
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('log')->default('default');
            $table->string('description');
            $table->integer('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->timestamps();

            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_log');
    }
}
