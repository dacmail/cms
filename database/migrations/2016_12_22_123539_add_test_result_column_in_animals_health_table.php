<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestResultColumnInAnimalsHealthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animals_health', function (Blueprint $table) {
            $table->string('test_result')->nullable()->after('treatments_time');
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
            $table->dropColumn('test_result');
        });
    }
}
