<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppMonetizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_monetizations', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('type', 15)->index();
            $table->boolean('enable')->default(true);
            $table->boolean('enable_from_pp')->default(true);
            $table->tinyInteger('priority')->default(50);
            $table->double('epc')->default(0);
            $table->json('extra_attributes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l2pp_monetizations');
    }
}
