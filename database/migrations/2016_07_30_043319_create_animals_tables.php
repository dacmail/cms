<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('web_id')->unsigned();
            $table->string('name');
            $table->string('old_name')->nullable();
            $table->string('visible')->default('visible');
            $table->string('litter')->nullable();
            $table->string('microchip')->nullable();
            $table->string('identifier')->nullable();
            $table->string('kind');
            $table->string('location');
            $table->string('gender');
            $table->string('status');
            $table->date('birth_date')->nullable();
            $table->boolean('birth_date_approximate')->default(0);
            $table->date('entry_date')->nullable();
            $table->boolean('entry_date_approximate')->default(0);
            $table->float('weight', 10, 2)->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->text('meta')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });

        Schema::create('animals_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->string('locale')->index();
            $table->string('breed')->nullable();
            $table->text('text')->nullable();
            $table->text('private_text')->nullable();
            $table->text('health_text')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unique(['animal_id', 'locale']);
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });

        Schema::create('animals_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->string('type');
            $table->string('file')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('url')->nullable();
            $table->boolean('main')->default(0);
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });

        Schema::create('animals_health', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->string('type');
            $table->string('title');
            $table->string('medicine')->nullable();
            $table->text('text')->nullable();
            $table->text('finish_text')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->float('cost', 10, 2)->nullable();
            $table->integer('treatments_number')->nullable();
            $table->integer('treatments_each')->nullable();
            $table->string('treatments_time')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });

        Schema::create('animals_sponsorships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned();
            $table->string('visible')->default('visible');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->float('donation', 10, 2)->nullable();
            $table->string('donation_time')->default('unknown');
            $table->string('payment_method')->nullable();
            $table->string('status')->default('status');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('text')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('animals_sponsorships');
        Schema::drop('animals_health');
        Schema::drop('animals_media');
        Schema::drop('animals_translations');
        Schema::drop('animals');
    }
}
