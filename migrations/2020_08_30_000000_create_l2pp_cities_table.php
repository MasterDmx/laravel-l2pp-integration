<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_cities', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary();
            $table->unsignedSmallInteger('region_id')->index();
            $table->string('slug', 100)->unique();
            $table->string('name', 100);
            $table->string('name_genitive', 100)->default('');
            $table->string('name_prepositional', 100)->default('');
            $table->string('pretext', 3)->default('');
            $table->char('kladr', 13)->default('');
            $table->unsignedDouble('center_coord_1')->default(0);
            $table->unsignedDouble('center_coord_2')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l2pp_cities');
    }
}
