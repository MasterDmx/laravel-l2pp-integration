<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppMonetizationsProductsPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_monetizations_products_p', function (Blueprint $table) {
            $table->unsignedInteger('monetization_id');
            $table->unsignedInteger('product_id');

            $table->primary(['monetization_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l2pp_monetizations_products_p');
    }
}
