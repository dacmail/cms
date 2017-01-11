<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->string('file')->nullable();
            $table->string('status');
            $table->string('side');
            $table->smallInteger('order');
            $table->string('type');
            $table->text('config')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });

        Schema::create('widgets_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('widget_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title', 50);
            $table->text('content')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['widget_id', 'locale']);
            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
        });

        Schema::create('widgets_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('widget_id')->unsigned();
            $table->string('type');
            $table->integer('order')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
        });

        Schema::create('widgets_links_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('link_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('link')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['link_id', 'locale']);
            $table->foreign('link_id')->references('id')->on('widgets_links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('widgets_links_translations');
        Schema::drop('widgets_links');
        Schema::drop('widgets_translations');
        Schema::drop('widgets');
    }
}
