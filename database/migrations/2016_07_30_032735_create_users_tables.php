<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('password', 60)->nullable();
            $table->string('oauth_provider')->nullable();
            $table->string('oauth_uid')->nullable();
            $table->string('status')->default('active');
            $table->string('type')->default('user');
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->dateTime('last_login')->nullable();
            $table->rememberToken();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['email', 'web_id']);
            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permission');
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('users_permissions', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['user_id', 'permission_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_permissions');
        Schema::drop('permissions');
        Schema::drop('users');
    }
}
