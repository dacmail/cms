<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });

        Schema::create('posts_categories_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('locale')->index();
            $table->text('title');
            $table->text('slug');
            $table->text('text')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['category_id', 'locale']);
            $table->foreign('category_id')->references('id')->on('posts_categories')->onDelete('cascade');
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('form_id')->unsigned()->nullable();
            $table->string('status');
            $table->boolean('fixed')->default(0);
            $table->string('comments_status')->default(1);
            $table->integer('comments')->default(0);
            $table->dateTime('published_at');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('posts_categories')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });

        Schema::create('posts_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('locale')->index();
            $table->text('title');
            $table->text('slug');
            $table->text('text');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['post_id', 'locale']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('posts_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('status');
            $table->text('comment');
            $table->text('moderated_comment')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::drop('posts_comments');
        Schema::drop('posts_translations');
        Schema::drop('posts');
        Schema::drop('posts_categories_translations');
        Schema::drop('posts_categories');
    }
}
