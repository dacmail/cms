<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->integer('form_id')->unsigned()->nullable();
            $table->string('status');
            $table->dateTime('published_at');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });

        Schema::create('pages_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('locale')->index();
            $table->text('title');
            $table->text('slug');
            $table->text('text')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['page_id', 'locale']);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages_translations');
        Schema::drop('pages');
    }
}
