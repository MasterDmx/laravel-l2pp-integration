<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_regions', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->default('');
            $table->string('name', 100)->default('');
            $table->string('name_genitive', 100)->default('');
            $table->string('name_prepositional', 100)->default('');
            $table->string('pretext', 3)->default('');
            $table->char('kladr', 13)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l2pp_regions');
    }
}
