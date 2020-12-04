<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateL2ppProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l2pp_products', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('organization_id');
            $table->string('service_id', 25);
            $table->string('name', 100)->default('');
            $table->string('slug', 100);
            $table->unsignedTinyInteger('priority')->default(50);
            $table->json('media');
            $table->json('extra_attributes');

            $table->unique(['organization_id', 'service_id', 'slug']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l2pp_products');
    }
}
