<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHiddenInCalendarColumnInAnimalsHealthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animals_health', function (Blueprint $table) {
            $table->boolean('hidden_in_calendar')->default(1)->after('test_result');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animals_health', function (Blueprint $table) {
            $table->dropColumn('hidden_in_calendar');
        });
    }
}
