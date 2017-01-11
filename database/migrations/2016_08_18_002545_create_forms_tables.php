<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->string('email');
            $table->string('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });

        Schema::create('forms_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('locale')->index();
            $table->text('subject');
            $table->text('title');
            $table->text('slug');
            $table->text('text')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['form_id', 'locale']);
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('forms_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->integer('order');
            $table->string('name');
            $table->string('type');
            $table->boolean('required');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });

        Schema::create('forms_fields_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_id')->unsigned();
            $table->string('locale')->index();
            $table->text('title');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['field_id', 'locale']);
            $table->foreign('field_id')->references('id')->on('forms_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms_fields_translations');
        Schema::dropIfExists('forms_fields');
        Schema::dropIfExists('forms_translations');
        Schema::dropIfExists('forms');
    }
}
