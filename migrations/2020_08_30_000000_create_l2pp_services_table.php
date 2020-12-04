<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_services', function (Blueprint $table) {
            $table->string('id', 25)->primary();
            $table->string('slug', 100)->unique();
            $table->string('name', 100);
            $table->string('name_plural', 100);
            $table->string('name_plural_genetive', 100);

            $table->index('slug');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l2pp_services');
    }
}
