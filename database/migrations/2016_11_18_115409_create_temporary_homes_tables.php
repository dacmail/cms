<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryHomesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_homes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('status');
            $table->text('text')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->integer('temporary_home_id')->unsigned()->nullable();

            $table->foreign('temporary_home_id')->references('id')->on('temporary_homes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animals', function ($table) {
            $table->dropForeign('animals_temporary_home_id_foreign');
            $table->dropColumn('temporary_home_id');
        });

        Schema::dropIfExists('temporary_homes');
    }
}
